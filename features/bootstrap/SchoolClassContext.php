<?php
use Behat\Behat\Context\BehatContext;
use Behat\Behat\Exception\PendingException;

class ScheduleContext extends BehatContext
{

    /**
     * @var SchoolClass
     */
    private $schoolClass;

    /**
     * @Given /^is a school class$/
     */
    public function isASchoolClass()
    {
        $this->schoolClass =  new SchoolClass();
    }

    /**
     * @When /^I setup the class$/
     */
    public function iSetupTheClass()
    {
        $this->schoolClass->setName('Programming');
        $this->schoolClass->setTeacher(new Teacher);
        $this->schoolClass->setClassRoom(new ClassRoom());
    }

    /**
     * @Then /^I get the name$/
     */
    public function iGetTheName()
    {
        assertEquals($this->schoolClass->getName(), 'Programming');
    }

    /**
     * @Given /^I get the teacher$/
     */
    public function iGetTheTeacher()
    {
        assertInstanceOf('Teacher', $this->schoolClass->getTeacher());
    }

    /**
     * @Given /^I get the class room$/
     */
    public function iGetTheClassRoom()
    {
        assertInstanceOf('ClassRoom', $this->schoolClass->getClassRoom());
    }

    /**
     * @Given /^I get the start date$/
     */
    public function iGetTheStartDate()
    {
        $this->schoolClass->setStartDate(new DateTime());
        assertInstanceOf('DateTime', $this->schoolClass->getStartDate());
    }

    /**
     * @Given /^I get the duration$/
     */
    public function iGetTheDuration()
    {
        $this->schoolClass->setDuration(90);
        $this->schoolClass->getDuration();

    }
}
