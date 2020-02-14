<?php

namespace EricksonReyes\DomainDrivenDesign\Common\ValueObject;

use EricksonReyes\DomainDrivenDesign\Common\Interfaces\CanCompareAmount;
use EricksonReyes\DomainDrivenDesign\Common\Interfaces\HasAmount;
use EricksonReyes\DomainDrivenDesign\Common\Interfaces\HasArrayRepresentation;
use EricksonReyes\DomainDrivenDesign\Common\ValueObject\Exception\MismatchedCurrenciesError;
use EricksonReyes\DomainDrivenDesign\Common\ValueObject\Exception\InsufficientMoneyAmountError;
use EricksonReyes\DomainDrivenDesign\Common\ValueObject\Exception\InvalidMoneyAmountError;

/**
 * Class Money
 * @package EricksonReyes\DomainDrivenDesign\Common\ValueObject
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class Money implements HasAmount, CanCompareAmount, HasArrayRepresentation
{
    /**
     * @var Currency
     */
    private $currency;

    /**
     * @var int
     */
    private $amount;

    public function __construct($amount, Currency $currency)
    {
        if ($amount < 0) {
            throw new InvalidMoneyAmountError(
                'Amount should not be less than zero. ' . $amount . ' is a negative number.'
            );
        }
        $this->amount = $amount;
        $this->currency = $currency;
    }

    /**
     * @return int
     */
    public function amount(): int
    {
        return $this->amount;
    }

    /**
     * @return Currency
     */
    public function currency(): Currency
    {
        return $this->currency;
    }

    /**
     * @param int $amount
     * @return bool
     */
    public function amountIsEqualsTo(int $amount): bool
    {
        return $this->amount() === $amount;
    }

    /**
     * @param int $amount
     * @return bool
     */
    public function amountIsNotEqualTo(int $amount): bool
    {
        return !$this->amountIsEqualsTo($amount);
    }


    /**
     * @param int $amount
     * @return bool
     */
    public function amountIsLessThan(int $amount): bool
    {
        return $this->amount() < $amount;
    }

    /**
     * @param int $amount
     * @return bool
     */
    public function amountIsGreaterThan(int $amount): bool
    {
        return $this->amount() > $amount;
    }

    /**
     * @param int $amount
     * @return bool
     */
    public function amountIsEqualOrLessThan(int $amount): bool
    {
        return $this->amount() <= $amount;
    }

    /**
     * @param int $amount
     * @return bool
     */
    public function amountIsEqualOrGreaterThan(int $amount): bool
    {
        return $this->amountIsEqualsTo($amount) || $this->amountIsGreaterThan($amount);
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'amount' => $this->amount(),
            'currency' => (string)$this->currency()
        ];
    }


    /**
     * @param Money $anotherMoney
     * @return bool
     */
    public function isEqualsTo(Money $anotherMoney): bool
    {
        $this->currenciesMustMatch($anotherMoney);
        return $this->amount() === $anotherMoney->amount();
    }

    /**
     * @param Money $anotherMoney
     * @return bool
     */
    public function isNotEqualTo(Money $anotherMoney): bool
    {
        $this->currenciesMustMatch($anotherMoney);
        return !$this->isEqualsTo($anotherMoney);
    }

    /**
     * @param Money $anotherMoney
     * @return bool
     */
    public function isLessThan(Money $anotherMoney): bool
    {
        $this->currenciesMustMatch($anotherMoney);
        return $this->amount() < $anotherMoney->amount();
    }

    /**
     * @param Money $anotherMoney
     * @return bool
     */
    public function isGreaterThan(Money $anotherMoney): bool
    {
        $this->currenciesMustMatch($anotherMoney);
        return $this->amount() > $anotherMoney->amount();
    }

    /**
     * @param Money $anotherMoney
     * @return bool
     */
    public function isEqualOrLessThan(Money $anotherMoney): bool
    {
        $this->currenciesMustMatch($anotherMoney);
        return $this->amount() <= $anotherMoney->amount();
    }

    /**
     * @param Money $anotherMoney
     * @return bool
     */
    public function isEqualOrGreaterThan(Money $anotherMoney): bool
    {
        $this->currenciesMustMatch($anotherMoney);
        return $this->amount() >= $anotherMoney->amount();
    }

    /**
     * @param Money $anotherMoney
     * @return Money
     */
    public function addWith(Money $anotherMoney): Money
    {
        $this->currenciesMustMatch($anotherMoney);

        $newAmount = $this->amount() + $anotherMoney->amount();
        return new Money($newAmount, $this->currency());
    }

    /**
     * @param $anotherMoney
     * @return Money
     */
    public function subtractWith(Money $anotherMoney): Money
    {
        $this->currenciesMustMatch($anotherMoney);
        $this->moneyMustHaveSufficientAmount($anotherMoney);

        $newAmount = $this->amount() - $anotherMoney->amount();
        return new Money($newAmount, $this->currency());
    }

    /**
     * @param Money $anotherMoney
     */
    private function currenciesMustMatch(Money $anotherMoney): void
    {
        $actualCurrency = (string)$this->currency();
        $anotherCurrency = (string)$anotherMoney->currency();
        if ($actualCurrency !== $anotherCurrency) {
            throw new MismatchedCurrenciesError(
                'Can\'t compare ' . $actualCurrency . ' with ' . $anotherCurrency
            );
        }
    }

    /**
     * @param Money $anotherMoney
     */
    private function moneyMustHaveSufficientAmount(Money $anotherMoney): void
    {
        if ($this->isLessThan($anotherMoney)) {
            throw new InsufficientMoneyAmountError(
                'The amount you are trying to subtract (' . $anotherMoney->amount() .
                ') is greater than ' . $this->amount() . '.'
            );
        }
    }
}
