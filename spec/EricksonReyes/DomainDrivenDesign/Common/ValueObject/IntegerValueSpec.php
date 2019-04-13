<?php

namespace spec\EricksonReyes\DomainDrivenDesign\Common\ValueObject;

use EricksonReyes\DomainDrivenDesign\Common\Attributes\ValueObject;
use EricksonReyes\DomainDrivenDesign\Common\ValueObject\IntegerValue;
use PhpSpec\ObjectBehavior;
use spec\EricksonReyes\DomainDrivenDesign\Common\UnitTestTrait;

class IntegerValueSpec extends ObjectBehavior
{
    use UnitTestTrait;

    /**
     * @var int
     */
    private $value;

    public function let()
    {
        $this->beConstructedWith($this->value = $this->seeder->randomDigit);

    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(IntegerValue::class);
        $this->shouldHaveType(ValueObject::class);
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

    public function it_can_be_matched(IntegerValue $sameInteger)
    {
        $sameInteger->value()->shouldBeCalled()->willReturn($this->value);
        $this->isEqualTo($sameInteger)->shouldReturn(true);
        $this->isNotEqualTo($sameInteger)->shouldReturn(false);
        $this->isLessThan($sameInteger)->shouldReturn(false);
        $this->isGreaterThan($sameInteger)->shouldReturn(false);
    }

    public function it_can_be_mismatched(IntegerValue $differentInteger)
    {
        $differentInteger->value()->shouldBeCalled()->willReturn($this->value + $this->seeder->numberBetween(1, 10));
        $this->isEqualTo($differentInteger)->shouldReturn(false);
        $this->isNotEqualTo($differentInteger)->shouldReturn(true);
    }

    public function it_can_do_math_operations(IntegerValue $aDifferentInteger)
    {
        $aDifferentValue = $this->seeder->numberBetween(1, 10);

        $expectedValue = $this->value + $aDifferentValue;
        $aDifferentInteger->value()->shouldBeCalled()->willReturn($aDifferentValue);
        $this->add($aDifferentInteger)->shouldHaveType(IntegerValue::class);
        $this->add($aDifferentInteger)->value()->shouldReturn($expectedValue);

        $expectedValue = $this->value - $aDifferentValue;
        $aDifferentInteger->value()->shouldBeCalled()->willReturn($aDifferentValue);
        $this->subtract($aDifferentInteger)->shouldHaveType(IntegerValue::class);
        $this->subtract($aDifferentInteger)->value()->shouldReturn($expectedValue);

        $expectedValue = $this->value * $aDifferentValue;
        $aDifferentInteger->value()->shouldBeCalled()->willReturn($aDifferentValue);
        $this->multiply($aDifferentInteger)->shouldHaveType(IntegerValue::class);
        $this->multiply($aDifferentInteger)->value()->shouldReturn($expectedValue);

        $expectedValue = intval($this->value / $aDifferentValue);
        $aDifferentInteger->value()->shouldBeCalled()->willReturn($aDifferentValue);
        $this->divide($aDifferentInteger)->shouldHaveType(IntegerValue::class);
        $this->divide($aDifferentInteger)->value()->shouldReturn($expectedValue);
    }

    public function it_can_do_comparisons(IntegerValue $aDifferentInteger)
    {
        $lesserValue = $this->value - 1;
        $aDifferentInteger->value()->shouldBeCalled()->willReturn($lesserValue);
        $this->isLessThan($aDifferentInteger)->shouldReturn(false);
        $this->isGreaterThan($aDifferentInteger)->shouldReturn(true);
        $this->isEqualTo($aDifferentInteger)->shouldReturn(false);
        $this->isNotEqualTo($aDifferentInteger)->shouldReturn(true);

        $greaterValue = $this->value + 1;
        $aDifferentInteger->value()->shouldBeCalled()->willReturn($greaterValue);
        $this->isLessThan($aDifferentInteger)->shouldReturn(true);
        $this->isGreaterThan($aDifferentInteger)->shouldReturn(false);
        $this->isEqualTo($aDifferentInteger)->shouldReturn(false);
        $this->isNotEqualTo($aDifferentInteger)->shouldReturn(true);

    }
}
