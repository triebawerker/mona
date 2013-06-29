<?php

namespace spec;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Prophecy\Prophet;

class TimeSlotSpec extends ObjectBehavior
{

    private $schoolClass;

    function let()
    {
        $prophet = new Prophet();
        $this->schoolClass = $prophet->prophesize('SchoolClass');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('TimeSlot');
    }

    function it_has_a_school_class()
    {
        $prophet = new Prophet();
        $prophecy = $prophet->prophesize();
        $prophecy->willExtend('SchoolClass');
        $dummySchoolClass = $prophecy->reveal();

        $this->setSchoolClass($dummySchoolClass);
        $this->isAllocated()->shouldBe(true);
    }

    function it_checks_if_a_class_has_a_start_date()
    {
        $this->schoolClass->getStartTime()->willReturn('15:30');

        $this->setSchoolClass($this->schoolClass);
        $this->shouldHaveClassStartDate();
    }

    function it_checks_if_class_has_a_duration()
    {
        $this->schoolClass->getDuration()->willReturn(75);

        $this->setSchoolClass($this->schoolClass);
        $this->shouldHaveClassEndDate();
    }

    function it_sets_start_and_end_date_for_new_school_class()
    {
        $this->schoolClass->getDuration()->willReturn(75);
        $this->schoolClass->getStartTime()->willReturn('08:30');
        $this->setSchoolClass($this->schoolClass);
        $this->setStartPoint();
        $this->setEndPoint();

        $this->getStartPoint()->shouldBe(34);
        $this->getEndPoint()->shouldBe(39);
    }

    function it_throws_exeption_on_invalid_start_time()
    {
        $startTimes = array('abc', 'aadf:adf', '123:123', '25:03', '23:60');

        $this->schoolClass->getDuration()->willReturn(75);

        foreach ($startTimes as $startTime) {
            $this->schoolClass->getStartTime()->willReturn('aadf:adf');
            $this->setSchoolClass($this->schoolClass);
            $this->shouldThrow('\Exception')->during('setStartPoint', array());
            $this->setEndPoint();
        }
    }
}