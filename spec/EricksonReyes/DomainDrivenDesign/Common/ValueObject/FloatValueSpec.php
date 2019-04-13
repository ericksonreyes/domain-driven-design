<?php

namespace spec\EricksonReyes\DomainDrivenDesign\Common\ValueObject;

use EricksonReyes\DomainDrivenDesign\Common\Attributes\ValueObject;
use EricksonReyes\DomainDrivenDesign\Common\ValueObject\FloatValue;
use PhpSpec\ObjectBehavior;
use spec\EricksonReyes\DomainDrivenDesign\Common\UnitTestTrait;

class FloatValueSpec extends ObjectBehavior
{
    use UnitTestTrait;

    /**
     * @var int
     */
    private $value;

    public function let()
    {
        $this->beConstructedWith($this->value = (float)$this->seeder->randomDigit);

    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(FloatValue::class);
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

    public function it_can_be_matched(FloatValue $sameInteger)
    {
        $sameInteger->value()->shouldBeCalled()->willReturn($this->value);
        $this->isEqualTo($sameInteger)->shouldReturn(true);
        $this->isNotEqualTo($sameInteger)->shouldReturn(false);
        $this->isLessThan($sameInteger)->shouldReturn(false);
        $this->isGreaterThan($sameInteger)->shouldReturn(false);
    }

    public function it_can_be_mismatched(FloatValue $differentInteger)
    {
        $differentInteger->value()->shouldBeCalled()->willReturn($this->value + $this->seeder->numberBetween(1, 10));
        $this->isEqualTo($differentInteger)->shouldReturn(false);
        $this->isNotEqualTo($differentInteger)->shouldReturn(true);
    }

    public function it_can_do_math_operations(FloatValue $aDifferentInteger)
    {
        $aDifferentValue = $this->seeder->numberBetween(1, 10);

        $expectedValue = $this->value + $aDifferentValue;
        $aDifferentInteger->value()->shouldBeCalled()->willReturn($aDifferentValue);
        $this->add($aDifferentInteger)->shouldHaveType(FloatValue::class);
        $this->add($aDifferentInteger)->value()->shouldReturn($expectedValue);

        $expectedValue = $this->value - $aDifferentValue;
        $aDifferentInteger->value()->shouldBeCalled()->willReturn($aDifferentValue);
        $this->subtract($aDifferentInteger)->shouldHaveType(FloatValue::class);
        $this->subtract($aDifferentInteger)->value()->shouldReturn($expectedValue);

        $expectedValue = $this->value * $aDifferentValue;
        $aDifferentInteger->value()->shouldBeCalled()->willReturn($aDifferentValue);
        $this->multiply($aDifferentInteger)->shouldHaveType(FloatValue::class);
        $this->multiply($aDifferentInteger)->value()->shouldReturn($expectedValue);

        $expectedValue = $this->value / $aDifferentValue;
        $aDifferentInteger->value()->shouldBeCalled()->willReturn($aDifferentValue);
        $this->divide($aDifferentInteger)->shouldHaveType(FloatValue::class);
        $this->divide($aDifferentInteger)->value()->shouldReturn($expectedValue);
    }

    public function it_can_do_comparisons(FloatValue $aDifferentInteger)
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
