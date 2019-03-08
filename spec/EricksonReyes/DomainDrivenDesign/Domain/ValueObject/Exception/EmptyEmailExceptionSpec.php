<?php

namespace spec\EricksonReyes\DomainDrivenDesign\ValueObject\Exception;

use EricksonReyes\DomainDrivenDesign\ValueObject\Exception\EmptyEmailException;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class EmptyEmailExceptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(EmptyEmailException::class);
    }
}
