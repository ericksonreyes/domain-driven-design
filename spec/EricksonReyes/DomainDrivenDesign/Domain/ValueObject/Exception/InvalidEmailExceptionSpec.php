<?php

namespace spec\EricksonReyes\DomainDrivenDesign\ValueObject\Exception;

use EricksonReyes\DomainDrivenDesign\ValueObject\Exception\InvalidEmailException;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class InvalidEmailExceptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(InvalidEmailException::class);
    }
}
