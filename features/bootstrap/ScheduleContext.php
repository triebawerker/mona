<?php
use Behat\Behat\Context\BehatContext;
use Behat\Behat\Exception\PendingException;
class SchoolClassContext extends BehatContext
{

    /**
     * @var SchoolClass
     */
    private $schoolClass;

    /**
     * @var Schedule
     */
    private $schedule;

    /**
     * @var TimeSlot
     */
    private $timeSlot;

    /**
     * @Given /^a schedule$/
     */
    public function aSchedule()
    {
        $this->schedule = new Schedule();
        $this->schedule->setDays(7);
        $this->schedule->setHours(24);
        $this->schedule->setTimeSlotLength(15);
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
        $this->schoolClass->setStartTime('15:30');
        $this->schoolClass->setDuration(90);
    }

    /**
     * @When /^I add the school class to my schedule$/
     */
    public function iAddTheSchoolClassToMySchedule()
    {
        $this->schedule->addSchoolClass($this->schoolClass);
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

    /**
     * @Given /^has a start point$/
     */
    public function hasAStartPoint()
    {
        $this->schedule->addSchoolClass($this->schoolClass);
        $slots = $this->schedule->getBookedSlots();
        foreach($slots as $slot) {
            assertGreaterThan(0, $slot->getStartPoint());
        }
    }

    /**
     * @Given /^has an end point$/
     */
    public function hasAnEndPoint()
    {
        $slots = $this->schedule->getBookedSlots();
        foreach($slots as $slot) {
            assertGreaterThan(0, $slot->getEndPoint());
        }
    }


    /**
     * @When /^a time time slot has a length of (\d+) minutes$/
     */
    public function aTimeTimeSlotHasALengthOfMinutes($arg1)
    {
        assertEquals($arg1, $this->schedule->getTimeSlotLength());
    }

    /**
     * @Given /^the schedule\'s week has (\d+) days$/
     */
    public function theScheduleSWeekHasDays($arg1)
    {
        assertEquals($arg1, $this->schedule->getDays());
    }

    /**
     * @Given /^the the schedule\'s day has (\d+) hours$/
     */
    public function theTheScheduleSDayHasHours($arg1)
    {
        assertEquals($arg1, $this->schedule->getHours());
    }


    /**
     * @Then /^I should have (\d+)\*(\d+)\*(\d+) time slots$/
     */
    public function iShouldHaveTimeSlots($arg1, $arg2, $arg3)
    {
        assertEquals(
            $arg1*$arg2*$arg3,
            $this->schedule->getScheduleNumberOfSlots()
        );
    }

    /**
     * @When /^I set up time slots in my schedule$/
     */
    public function iSetUpTimeSlotsInMySchedule()
    {
        throw new PendingException();
    }

    /**
     * @Then /^the time slots must not overlap$/
     */
    public function theTimeSlotsMustNotOverlap()
    {
        throw new PendingException();
    }

}
