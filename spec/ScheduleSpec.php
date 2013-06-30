<?php

namespace spec;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Prophecy\Prophet;
use TimeSlotFactory;


class ScheduleSpec extends ObjectBehavior
{

    private $prophet;

    /**
     * @param TimeSlotFactory $timeSlotFactory
     */
    function let( $timeSlotFactory)
    {
        $this->prophet = new Prophet;
        $timeSlot = $this->createStubTimeSlot(1, 3);

        $timeSlotFactory = $this->prophet->prophesize('TimeSlotFactory');
        $timeSlotFactory->createTimeSlot()->willReturn($timeSlot);

        $this->beConstructedWith($timeSlotFactory);

    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Schedule');
    }

    function it_can_add_a_school_class()
    {
        $schoolClass = $this->prophet->prophesize('SchoolClass');

        $this->addSchoolClass($schoolClass);

        $this->getSchoolClassList()->shouldHaveCount(1);
        $schoolClass = $this->getSchoolClassList();
        $schoolClass[0]->shouldHaveType('SchoolClass');
    }

    function it_can_show_a_list_of_school_classes()
    {
        $schoolClass1 = $this->prophet->prophesize('SchoolClass');
        $schoolClass2 = $this->prophet->prophesize('SchoolClass');

        $timeSlot1 = $this->createStubTimeSlot(1, 3);
        $this->addSchoolClass($schoolClass1, $timeSlot1);

        $timeSlot2 = $this->createStubTimeSlot(4, 6);
        $this->addSchoolClass($schoolClass2, $timeSlot2);

        $this->getSchoolClassList()->shouldHaveCount(2);

        $schoolClass = $this->getSchoolClassList();
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

    function it_checks_for_overlaps()
    {

        $schoolClass1 = $this->prophet->prophesize('SchoolClass');
        $schoolClass1->getStartTime()->willReturn('15:30');
        $schoolClass1->getDuration()->willReturn('60');

        $schoolClass2 = $this->prophet->prophesize('SchoolClass');
        $schoolClass2->getStartTime()->willReturn('18:30');
        $schoolClass2->getDuration()->willReturn('60');

        $schoolClass3 = $this->prophet->prophesize('SchoolClass');
        $schoolClass3->getStartTime()->willReturn('16:30');
        $schoolClass3->getDuration()->willReturn('60');


        $timeSlot = $this->createStubTimeSlot(40, 42);
        $this->addSchoolClass($schoolClass1, $timeSlot);

        $timeSlot = $this->createStubTimeSlot(45, 47);
        $this->addSchoolClass($schoolClass2, $timeSlot);

        $this->getSchoolClassList()->shouldHaveCount(2);

        $timeSlot = $this->createStubTimeSlot(42, 45);
        $this->shouldThrow('Exception')->during('addSchoolClass', array($schoolClass3, $timeSlot));

        $timeSlot = $this->createStubTimeSlot(43, 45);
        $this->shouldThrow('Exception')->during('addSchoolClass', array($schoolClass3, $timeSlot));

        $timeSlot = $this->createStubTimeSlot(41, 46);
        $this->shouldThrow('Exception')->during('addSchoolClass', array($schoolClass3, $timeSlot));

        $timeSlot = $this->createStubTimeSlot(43, 44);
        $this->addSchoolClass($schoolClass3, $timeSlot);
    }

    private function createStubTimeSlot($startPoint, $endPoint){
        $timeSlot = $this->prophet->prophesize('TimeSlot');
        $timeSlot->setStartPoint()->willReturn(null);
        $timeSlot->setEndPoint()->willReturn(null);
        $timeSlot->setSchoolClass(Argument::any())->willReturn(null);
        $timeSlot->setSchoolClass(Argument::any())->willReturn(null);
        $timeSlot->setSchoolClass(Argument::any())->willReturn(null);
        $timeSlot->getStartPoint()->willReturn($startPoint);
        $timeSlot->getEndPoint()->willReturn($endPoint);
        $timeSlot->isAllocated()->willReturn(true);

        return $timeSlot;
    }
}
