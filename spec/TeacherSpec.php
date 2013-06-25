<?php

namespace spec;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Prophecy\Prophet;

class TeacherSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Teacher');
    }
}
