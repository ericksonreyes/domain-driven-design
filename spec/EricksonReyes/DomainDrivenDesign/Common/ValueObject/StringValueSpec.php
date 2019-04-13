<?php

namespace spec\EricksonReyes\DomainDrivenDesign\Common\ValueObject;

use EricksonReyes\DomainDrivenDesign\Common\Attributes\ValueObject;
use EricksonReyes\DomainDrivenDesign\Common\ValueObject\StringValue;
use PhpSpec\ObjectBehavior;
use spec\EricksonReyes\DomainDrivenDesign\Common\UnitTestTrait;

class StringValueSpec extends ObjectBehavior
{
    use UnitTestTrait;

    /**
     * @var string
     */
    private $value;

    public function let()
    {
        $this->beConstructedWith($this->value = $this->seeder->paragraph);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(StringValue::class);
        $this->shouldHaveType(ValueObject::class);
    }

    public function it_can_be_converted_to_string()
    {
        $this->__toString()->shouldReturn($this->value);
    }

    public function it_has_value()
    {
        $this->value()->shouldReturn($this->value);
    }

    public function it_has_array_representation()
    {
        $this->toArray([
            'value' => $this->value
        ]);
    }

    public function it_can_be_matched(StringValue $sameString)
    {
        $sameString->value()->shouldBeCalled()->willReturn($this->value);
        $this->matches($sameString)->shouldReturn(true);
        $this->doesNotMatch($sameString)->shouldReturn(false);
    }

    public function it_can_be_mismatched(StringValue $differentString)
    {
        $differentString->value()->shouldBeCalled()->willReturn($this->seeder->paragraph);
        $this->matches($differentString)->shouldReturn(false);
        $this->doesNotMatch($differentString)->shouldReturn(true);
    }
}
