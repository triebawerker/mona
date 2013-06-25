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
        $this->addSchool($this->dummySchoolClass[0]);

        $this->getSchool()->shouldHaveCount(1);
        $schoolClass = $this->getSchool();
        $schoolClass[0]->shouldHaveType('SchoolClass');
    }

    function it_can_show_a_list_of_school_classes()
    {
        $this->addSchool($this->dummySchoolClass[0]);
        $this->addSchool($this->dummySchoolClass[1]);

        $this->getSchool()->shouldHaveCount(2);

        $schoolClass = $this->getSchool();
        $schoolClass[0]->shouldReturnAnInstanceOf('SchoolClass');
        $schoolClass[1]->shouldReturnAnInstanceOf('SchoolClass');
    }

    function it_can_get_free_slots()
    {
        $prophet = new Prophet;
        $prophecy = $prophet->prophesize();
        $prophecy->willExtend('TimeSlot');
        $dummySlot = $prophecy->reveal();

        $this->addTimeslot($dummySlot);
        $this->getFreeSlots()->shouldBeArray();
        $this->getFreeSlots()->shouldHaveCount(1);
    }
}
