<?php

namespace spec\EricksonReyes\DomainDrivenDesign\ValueObject\Exception;

use EricksonReyes\DomainDrivenDesign\ValueObject\Exception\ShortPasswordException;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ShortPasswordExceptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(ShortPasswordException::class);
    }
}
