<?php

namespace spec;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Prophecy\Prophet;

class TimeSlotSpec extends ObjectBehavior
{

    function it_is_initializable()
    {
        $this->shouldHaveType('TimeSlot');
    }

    function it_has_a_school_class()
    {
        $prophet = new Prophet;
        $prophecy = $prophet->prophesize();
        $prophecy->willExtend('SchoolClass');
        $dummySchoolClass = $prophecy->reveal();

        $this->setSchoolClass($dummySchoolClass);
        $this->isAllocated()->shouldBe(true);
    }
}