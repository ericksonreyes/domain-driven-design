<?php

namespace spec\EricksonReyes\DomainDrivenDesign\Common\ValueObject;

use EricksonReyes\DomainDrivenDesign\Common\Attributes\ValueObject;
use EricksonReyes\DomainDrivenDesign\Common\ValueObject\Currency;
use EricksonReyes\DomainDrivenDesign\Common\ValueObject\Exception\CurrencyMismatchException;
use EricksonReyes\DomainDrivenDesign\Common\ValueObject\Money;
use PhpSpec\ObjectBehavior;
use spec\EricksonReyes\DomainDrivenDesign\Common\UnitTestTrait;

class MoneySpec extends ObjectBehavior
{
    use UnitTestTrait;

    /**
     * @var Currency;
     */
    private $currency;

    /**
     * @var int
     */
    private $value;

    public function let(Currency $currency)
    {
        $this->beConstructedWith(
            $this->currency = $currency,
            $this->value = $this->seeder->numberBetween(1, 100)
        );
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(Money::class);
        $this->shouldHaveType(ValueObject::class);
    }

    public function it_has_currency()
    {
        $this->currency()->shouldReturn($this->currency);
    }

    public function it_has_value()
    {
        $this->value()->shouldReturn($this->value);
    }


    public function it_has_an_array_representation()
    {
        $this->currency->toArray()->shouldBeCalled()->willReturn($expectedCurrencyArray = $this->seeder->sentences);
        $this->toArray()->shouldReturn([
            'currency' => $expectedCurrencyArray,
            'value' => $this->value
        ]);
    }

    public function it_can_be_incremented(
        Money $moneyToBeAdded,
        Currency $aDifferentCurrency
    )
    {
        $valueToBeAdded = $this->seeder->numberBetween(20, 100);

        $moneyToBeAdded->value()->shouldBeCalled()->willReturn($valueToBeAdded);
        $moneyToBeAdded->currency()->shouldBeCalled()->willReturn($aDifferentCurrency);

        $this->currency->doesNotMatch($aDifferentCurrency)->shouldBeCalled()->willReturn(false);

        $expectedNewValue = $this->value + $valueToBeAdded;
        $this->add($moneyToBeAdded)->shouldHaveType(Money::class);
        $this->add($moneyToBeAdded)->value()->shouldReturn($expectedNewValue);
    }

    public function it_only_accept_same_currencies_for_addition(
        Money $moneyToBeAdded,
        Currency $aDifferentCurrency
    )
    {
        $aDifferentCurrency->code()->shouldBeCalled()->willReturn('MXN');
        $moneyToBeAdded->currency()->shouldBeCalled()->willReturn($aDifferentCurrency);

        $this->currency->code()->shouldBeCalled()->willReturn('PHP');
        $this->currency->doesNotMatch($aDifferentCurrency)->shouldBeCalled()->willReturn(true);
        $this->shouldThrow(CurrencyMismatchException::class)->during(
            'add',
            [
                $moneyToBeAdded
            ]
        );
    }

    public function it_can_be_deducted(
        Money $moneyToBeDeducted,
        Currency $aDifferentCurrency
    )
    {
        $valueToBeDeducted = $this->seeder->numberBetween(20, 100);

        $moneyToBeDeducted->value()->shouldBeCalled()->willReturn($valueToBeDeducted);
        $moneyToBeDeducted->currency()->shouldBeCalled()->willReturn($aDifferentCurrency);

        $this->currency->doesNotMatch($aDifferentCurrency)->shouldBeCalled()->willReturn(false);

        $expectedNewAmount = $this->value - $valueToBeDeducted;
        $this->deduct($moneyToBeDeducted)->shouldHaveType(Money::class);
        $this->deduct($moneyToBeDeducted)->value()->shouldReturn($expectedNewAmount);
    }

    public function it_only_accept_same_currencies_for_deduction(
        Money $moneyToBeDeducted,
        Currency $aDifferentCurrency
    )
    {
        $aDifferentCurrency->code()->shouldBeCalled()->willReturn('MXN');
        $moneyToBeDeducted->currency()->shouldBeCalled()->willReturn($aDifferentCurrency);

        $this->currency->code()->shouldBeCalled()->willReturn('PHP');
        $this->currency->doesNotMatch($aDifferentCurrency)->shouldBeCalled()->willReturn(true);
        $this->shouldThrow(CurrencyMismatchException::class)->during(
            'deduct',
            [
                $moneyToBeDeducted
            ]
        );
    }

    public function it_can_be_matched(Money $sameMoney, Currency $sameCurrency)
    {
        $sameMoney->value()->shouldBeCalled()->willReturn($this->value);
        $sameMoney->currency()->shouldBeCalled()->willReturn($sameCurrency);
        $this->currency->matches($sameCurrency)->shouldBeCalled()->willReturn(true);

        $this->isEqualTo($sameMoney)->shouldReturn(true);
        $this->isNotEqualTo($sameMoney)->shouldReturn(false);
    }

    public function it_can_be_mismatched(Money $aDifferentMoney, Currency $aDifferentCurrency)
    {
        $aDifferentMoney->value()->shouldBeCalled()->willReturn($this->value);
        $aDifferentMoney->currency()->shouldBeCalled()->willReturn($aDifferentCurrency);
        $this->currency->matches($aDifferentCurrency)->shouldBeCalled()->willReturn(false);

        $this->isEqualTo($aDifferentMoney)->shouldReturn(false);
        $this->isNotEqualTo($aDifferentMoney)->shouldReturn(true);

        $aDifferentMoney->value()->shouldBeCalled()->willReturn($this->seeder->numberBetween(1, 10));
        $this->isEqualTo($aDifferentMoney)->shouldReturn(false);
        $this->isNotEqualTo($aDifferentMoney)->shouldReturn(true);
    }

}
