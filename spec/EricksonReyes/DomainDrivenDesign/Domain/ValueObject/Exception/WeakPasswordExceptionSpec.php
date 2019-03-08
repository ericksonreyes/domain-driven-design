<?php

namespace spec\EricksonReyes\DomainDrivenDesign\ValueObject\Exception;

use EricksonReyes\DomainDrivenDesign\ValueObject\Exception\WeakPasswordException;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class WeakPasswordExceptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(WeakPasswordException::class);
    }
}
