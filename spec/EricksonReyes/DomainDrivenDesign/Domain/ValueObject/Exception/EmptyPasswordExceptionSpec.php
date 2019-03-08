<?php

namespace spec\EricksonReyes\DomainDrivenDesign\ValueObject\Exception;

use EricksonReyes\DomainDrivenDesign\ValueObject\Exception\EmptyPasswordException;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class EmptyPasswordExceptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(EmptyPasswordException::class);
    }
}
