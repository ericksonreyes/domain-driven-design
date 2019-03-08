<?php

namespace spec\EricksonReyes\DomainDrivenDesign\ValueObject\Exception;

use EricksonReyes\DomainDrivenDesign\ValueObject\Exception\PasswordDoesNotContainLettersAndNumbersException;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PasswordDoesNotContainLettersAndNumbersExceptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(PasswordDoesNotContainLettersAndNumbersException::class);
    }
}
