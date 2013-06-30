<?php

namespace spec;

use PhpSpec\ObjectBehavior;

class TimeSlotFactorySpec extends ObjectBehavior {

    function it_is_initializable()
    {
        $this->shouldHaveType('TimeSlotFactory');
    }

    function it_can_create_a_time_slot()
    {
        $this->createTimeSlot()->shouldHaveType('TimeSlot');
    }
}