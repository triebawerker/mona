<?php

namespace spec;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ClassRoomSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('ClassRoom');
    }
}
