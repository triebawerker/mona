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

}
