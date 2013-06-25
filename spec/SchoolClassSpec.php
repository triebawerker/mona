<?php

namespace spec;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Prophecy\Prophet;

class SchoolClassSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('SchoolClass');
    }

    function it_has_a_name()
    {
        $this->setName('className');
        $this->getName()->shouldReturn('className');
    }

    function it_has_a_teacher()
    {
        $prophet = new Prophet;
        $prophecy = $prophet->prophesize();
        $prophecy->willExtend('Teacher');
        $dummyTeacher = $prophecy->reveal();

        $this->setTeacher($dummyTeacher);
        $this->getTeacher()->shouldHaveType('Teacher');
    }

    function it_has_class_room()
    {
        $prophet = new Prophet;
        $prophecy = $prophet->prophesize();
        $prophecy->willExtend('ClassRoom');
        $dummyClassRoom = $prophecy->reveal();

        $this->setClassRoom($dummyClassRoom);
        $this->getClassRoom()->shouldHaveType('ClassRoom');
    }
}
