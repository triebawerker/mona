<?php
use Behat\Behat\Context\BehatContext;
use Behat\Behat\Exception\PendingException;



class SchoolClassContext extends BehatContext
{

    private $schoolClass;
    private $schedule;
    private $timeSlot;

    /**
     * @Given /^a schedule$/
     */
    public function aSchedule()
    {
        $this->schedule = new Schedule();
        assertInstanceOf('Schedule', $this->schedule);
    }

    /**
     * @Given /^time slots$/
     */
    public function timeSlots()
    {
        $this->timeSlot = new TimeSlot();
    }

    /**
     * @Given /^a school class$/
     */
    public function aSchoolClass()
    {
        $this->schoolClass = new SchoolClass();
        $this->schoolClass->setName('Programming');
    }

    /**
     * @When /^I add the school class to my schedule$/
     */
    public function iAddTheSchoolClassToMySchedule()
    {
        $this->schedule->addSchool($this->schoolClass);
    }


    /**
     * @Then /^I should get a List of available classes$/
     */
    public function iShouldGetAListOfAvailableClasses()
    {
        assertTrue(is_array($this->schedule->getList()));
    }

    /**
     * @When /^I have added time slots$/
     */
    public function iHaveAddedTimeSlots()
    {
        $this->schedule->addTimeslot($this->timeSlot);
    }

    /**
     * @Then /^I should get a list of time slots$/
     */
    public function iShouldGetAListOfTimeSlots()
    {
        $this->schedule->addTimeslot($this->timeSlot);
        assertTrue(is_array($this->schedule->getFreeSlots()));
    }

    /**
     * @When /^I assign a school class to a time slot$/
     */
    public function iAssignASchoolClassToATimeSlot()
    {
        $this->timeSlot->setSchoolClass($this->schoolClass);
        $this->schedule->addTimeslot($this->timeSlot);

        $slots = $this->schedule->getBookedSlots();
        assertTrue(is_array($slots));
    }

    /**
     * @Then /^the time slot is allocated$/
     */
    public function theTimeSlotIsAllocated()
    {
        $slots = $this->schedule->getBookedSlots();
        assertTrue($slots[0]->isAllocated());
    }

    /**
     * @Given /^could not be allocated again$/
     */
    public function couldNotBeAllocatedAgain()
    {
        assertCount(0, $this->schedule->getFreeSlots());
    }


}
