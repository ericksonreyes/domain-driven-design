<?php

namespace spec\EricksonReyes\DomainDrivenDesign\Common\ValueObject;

use EricksonReyes\DomainDrivenDesign\Common\Interfaces\CanCompareAmount;
use EricksonReyes\DomainDrivenDesign\Common\Interfaces\HasAmount;
use EricksonReyes\DomainDrivenDesign\Common\Interfaces\HasArrayRepresentation;
use EricksonReyes\DomainDrivenDesign\Common\ValueObject\Currency;
use EricksonReyes\DomainDrivenDesign\Common\ValueObject\Exception\MismatchedCurrenciesError;
use EricksonReyes\DomainDrivenDesign\Common\ValueObject\Exception\InsufficientMoneyAmountError;
use EricksonReyes\DomainDrivenDesign\Common\ValueObject\Exception\InvalidMoneyAmountError;
use EricksonReyes\DomainDrivenDesign\Common\ValueObject\Money;
use PhpSpec\ObjectBehavior;
use spec\EricksonReyes\DomainDrivenDesign\Common\UnitTestTrait;

class MoneySpec extends ObjectBehavior
{
    use UnitTestTrait;
    /**
     * @var int
     */
    private $amount;

    /**
     * @var Currency
     */
    private $currency;

    public function let()
    {
        $currency = new Currency($this->seeder->currencyCode);
        $this->beConstructedWith(
            $this->amount = mt_rand(5, 100),
            $this->currency = $currency
        );
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(Money::class);
        $this->shouldImplement(HasAmount::class);
        $this->shouldImplement(CanCompareAmount::class);
        $this->shouldImplement(HasArrayRepresentation::class);
    }

    public function it_rejects_negative_amounts()
    {
        $negativeNumber = 0 - mt_rand(1, 10);

        $this->shouldThrow(InvalidMoneyAmountError::class)->during(
            '__construct',
            [
                $negativeNumber,
                $this->currency
            ]
        );
    }

    public function it_has_an_amount()
    {
        $this->amount()->shouldReturn($this->amount);
    }

    public function it_has_currency()
    {
        $this->currency()->shouldReturn($this->currency);
    }

    public function it_has_array_representation()
    {
        $this->toArray()->shouldReturn(
            [
                'amount' => $this->amount,
                'currency' => (string)$this->currency
            ]
        );
    }

    public function it_can_compare_exact_amounts()
    {
        $exactAmount = $this->amount;

        $this->amountIsEqualsTo($exactAmount)->shouldReturn(true);
        $this->amountIsNotEqualTo($exactAmount)->shouldReturn(false);

        $this->amountIsLessThan($exactAmount)->shouldReturn(false);
        $this->amountIsGreaterThan($exactAmount)->shouldReturn(false);

        $this->amountIsEqualOrLessThan($exactAmount)->shouldReturn(true);
        $this->amountIsEqualOrGreaterThan($exactAmount)->shouldReturn(true);
    }

    public function it_can_determine_if_it_exceeds_the_amount_limit()
    {
        $lesserAmount = $this->amount - mt_rand(1, $this->amount);

        $this->amountIsEqualsTo($lesserAmount)->shouldReturn(false);
        $this->amountIsNotEqualTo($lesserAmount)->shouldReturn(true);

        $this->amountIsLessThan($lesserAmount)->shouldReturn(false);
        $this->amountIsGreaterThan($lesserAmount)->shouldReturn(true);

        $this->amountIsEqualOrLessThan($lesserAmount)->shouldReturn(false);
        $this->amountIsEqualOrGreaterThan($lesserAmount)->shouldReturn(true);
    }

    public function it_can_determine_if_it_does_not_meet_the_amount_limit()
    {
        $greaterAmount = $this->amount + mt_rand(1, $this->amount - 1);

        $this->amountIsEqualsTo($greaterAmount)->shouldReturn(false);
        $this->amountIsNotEqualTo($greaterAmount)->shouldReturn(true);

        $this->amountIsLessThan($greaterAmount)->shouldReturn(true);
        $this->amountIsGreaterThan($greaterAmount)->shouldReturn(false);

        $this->amountIsEqualOrLessThan($greaterAmount)->shouldReturn(true);
        $this->amountIsEqualOrGreaterThan($greaterAmount)->shouldReturn(false);
    }

    public function it_can_be_exactly_compared_with_another_money()
    {
        $exactAmount = $this->amount;
        $anotherMoney = new Money($exactAmount, $this->currency);

        $this->isEqualsTo($anotherMoney)->shouldReturn(true);
        $this->isNotEqualTo($anotherMoney)->shouldReturn(false);

        $this->isLessThan($anotherMoney)->shouldReturn(false);
        $this->isGreaterThan($anotherMoney)->shouldReturn(false);

        $this->isEqualOrLessThan($anotherMoney)->shouldReturn(true);
        $this->isEqualOrGreaterThan($anotherMoney)->shouldReturn(true);
    }

    public function it_can_be_determined_if_this_is_lesser_than_another_money()
    {
        $greaterAmount = $this->amount + mt_rand(1, 5);
        $anotherMoney = new Money($greaterAmount, $this->currency);

        $this->isEqualsTo($anotherMoney)->shouldReturn(false);
        $this->isNotEqualTo($anotherMoney)->shouldReturn(true);

        $this->isLessThan($anotherMoney)->shouldReturn(true);
        $this->isGreaterThan($anotherMoney)->shouldReturn(false);

        $this->isEqualOrLessThan($anotherMoney)->shouldReturn(true);
        $this->isEqualOrGreaterThan($anotherMoney)->shouldReturn(false);
    }

    public function it_can_be_determined_if_this_is_greater_than_another_money()
    {
        $lesserAmount = $this->amount - mt_rand(1, $this->amount);
        $anotherMoney = new Money($lesserAmount, $this->currency);

        $this->isEqualsTo($anotherMoney)->shouldReturn(false);
        $this->isNotEqualTo($anotherMoney)->shouldReturn(true);

        $this->isLessThan($anotherMoney)->shouldReturn(false);
        $this->isGreaterThan($anotherMoney)->shouldReturn(true);

        $this->isEqualOrLessThan($anotherMoney)->shouldReturn(false);
        $this->isEqualOrGreaterThan($anotherMoney)->shouldReturn(true);
    }

    public function it_can_be_added_with_another_money()
    {
        $amountToAdd = mt_rand(1, 50);
        $expectedAmount = $this->amount + $amountToAdd;

        $anotherMoney = new Money($amountToAdd, $this->currency);
        $this->addWith($anotherMoney)->shouldHaveType(Money::class);
        $this->addWith($anotherMoney)->shouldNotReturn($this);
        $this->addWith($anotherMoney)->amount()->shouldReturn($expectedAmount);
    }

    public function it_can_be_subtracted_with_another_money()
    {
        $amountToLessen = mt_rand(1, $this->amount);
        $expectedAmount = $this->amount - $amountToLessen;

        $anotherMoney = new Money($amountToLessen, $this->currency);
        $this->subtractWith($anotherMoney)->shouldHaveType(Money::class);
        $this->subtractWith($anotherMoney)->shouldNotReturn($this);
        $this->subtractWith($anotherMoney)->amount()->shouldReturn($expectedAmount);
    }

    public function it_cannot_be_subtracted_with_a_greater_money()
    {
        $amountToLessen = mt_rand($this->amount + 1, $this->amount + 10);

        $anotherMoney = new Money($amountToLessen, $this->currency);
        $this->shouldThrow(InsufficientMoneyAmountError::class)->during(
            'subtractWith',
            [
                $anotherMoney
            ]
        );
    }

    public function it_will_not_compare_mismatched_currencies()
    {
        $anotherMoney = new Money(100, new Currency($this->seeder->currencyCode));
        $this->shouldThrow(MismatchedCurrenciesError::class)->during(
            'isEqualsTo', [$anotherMoney]
        );
        $this->shouldThrow(MismatchedCurrenciesError::class)->during(
            'isNotEqualTo', [$anotherMoney]
        );
        $this->shouldThrow(MismatchedCurrenciesError::class)->during(
            'isLessThan', [$anotherMoney]
        );
        $this->shouldThrow(MismatchedCurrenciesError::class)->during(
            'isGreaterThan', [$anotherMoney]
        );
        $this->shouldThrow(MismatchedCurrenciesError::class)->during(
            'isEqualOrLessThan', [$anotherMoney]
        );
        $this->shouldThrow(MismatchedCurrenciesError::class)->during(
            'isEqualOrGreaterThan', [$anotherMoney]
        );
        $this->shouldThrow(MismatchedCurrenciesError::class)->during(
            'addWith', [$anotherMoney]
        );
        $this->shouldThrow(MismatchedCurrenciesError::class)->during(
            'subtractWith', [$anotherMoney]
        );
    }
}
