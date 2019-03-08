<?php

namespace EricksonReyes\DomainDrivenDesign\Domain\ValueObject;

class Money
{


    /**
     * @var int
     */
    private $amount;

    /**
     * @var Currency
     */
    private $currency;

    /**
     * Money constructor.
     * @param int $amount
     * @param Currency $currency
     */
    public function __construct(int $amount, Currency $currency)
    {
        $this->amount = $amount;
        $this->currency = $currency;
    }

    /**
     * @return Currency
     */
    public function currency(): Currency
    {
        return $this->currency;
    }

    /**
     * @return int
     */
    public function amount(): int
    {
        return $this->amount;
    }

    /**
     * @param int $amount
     * @return Money
     */
    public function incrementBy(int $amount): Money
    {
        $newAmount = $this->amount() + $amount;
        return new self($newAmount, $this->currency);
    }

    /**
     * @param int $amount
     * @return Money
     */
    public function decrementBy(int $amount): Money
    {
        $newAmount = $this->amount() - $amount;
        return new self($newAmount, $this->currency);
    }

    /**
     * @param int $number
     * @return Money
     */
    public function multiplyBy(int $number): Money
    {
        $newAmount = $this->amount() * $number;
        return new self($newAmount, $this->currency);
    }

    /**
     * @param int $number
     * @return Money
     */
    public function divideBy(int $number): Money
    {
        $newAmount = $this->amount() / $number;
        return new self($newAmount, $this->currency);
    }

    /**
     * @param Currency $newCurrency
     * @param int $exchangeRate
     * @return Money
     */
    public function convertTo(Currency $newCurrency, int $exchangeRate): Money
    {
        $newAmount = $this->amount() * $exchangeRate;
        return new self($newAmount, $newCurrency);
    }


}
