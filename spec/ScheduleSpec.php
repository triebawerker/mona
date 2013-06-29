<?php

namespace spec;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Prophecy\Prophet;


class ScheduleSpec extends ObjectBehavior
{

    private $dummySchoolClass = array();

    function let($dummySchoolClass)
    {
        $prophet = new Prophet;
        $prophecy = $prophet->prophesize();
        $prophecy->willExtend('SchoolClass');
        $this->dummySchoolClass[] = $prophecy->reveal();
        $this->dummySchoolClass[] = $prophecy->reveal();
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Schedule');
    }

    function it_can_add_a_school_class()
    {
        $this->addSchoolClass($this->dummySchoolClass[0]);

        $this->getSchool()->shouldHaveCount(1);
        $schoolClass = $this->getSchool();
        $schoolClass[0]->shouldHaveType('SchoolClass');
    }

    function it_can_show_a_list_of_school_classes()
    {
        $this->addSchoolClass($this->dummySchoolClass[0]);
        $this->addSchoolClass($this->dummySchoolClass[1]);

        $this->getSchool()->shouldHaveCount(2);

        $schoolClass = $this->getSchool();
        $schoolClass[0]->shouldReturnAnInstanceOf('SchoolClass');
        $schoolClass[1]->shouldReturnAnInstanceOf('SchoolClass');
    }

    function it_calcutes_slot_per_schedule()
    {
        $this->setDays(7);
        $this->setHours(24);
        $this->setTimeSlotLength(15);

        $this->getScheduleNumberOfSlots()->shouldBe(7*24*4);
    }
}
