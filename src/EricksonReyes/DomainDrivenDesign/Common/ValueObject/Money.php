<?php

namespace EricksonReyes\DomainDrivenDesign\Common\ValueObject;

use EricksonReyes\DomainDrivenDesign\Common\Attributes\ValueObject;
use EricksonReyes\DomainDrivenDesign\Common\ValueObject\Exception\CurrencyMismatchException;

/**
 * Class Money
 * @package EricksonReyes\DomainDrivenDesign\Common\ValueObject
 */
class Money implements ValueObject
{
    /**
     * @var Currency;
     */
    private $currency;

    /**
     * @var int
     */
    private $value;

    /**
     * Money constructor.
     * @param Currency $currency
     * @param int $value
     */
    public function __construct(Currency $currency, int $value)
    {
        $this->currency = $currency;
        $this->value = $value;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'currency' => $this->currency->toArray(),
            'value' => $this->value()
        ];
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
    public function value(): int
    {
        return $this->value;
    }

    /**
     * @param Money $moneyToBeAdded
     * @return Money
     */
    public function add(Money $moneyToBeAdded): self
    {
        if ($this->currencyIsAllowed($moneyToBeAdded->currency())) {
            throw new CurrencyMismatchException(
                'You can\'t add ' . $moneyToBeAdded->currency()->code() . ' with '
                . $this->currency()->code() . '.'
            );
        }

        $value = $this->value() + $moneyToBeAdded->value();
        return new self($this->currency, $value);
    }

    /**
     * @param Money $moneyToBeDeducted
     * @return Money
     */
    public function deduct(Money $moneyToBeDeducted): self
    {
        if ($this->currencyIsAllowed($moneyToBeDeducted->currency())) {
            throw new CurrencyMismatchException(
                'You can\'t deduct ' . $moneyToBeDeducted->currency()->code() . ' from '
                . $this->currency()->code() . '.'
            );
        }

        $value = $this->value() - $moneyToBeDeducted->value();
        return new self($this->currency, $value);
    }

    /**
     * @param Money $anotherMoney
     * @return bool
     */
    public function isEqualTo(Money $anotherMoney): bool
    {
        if ($anotherMoney->value() !== $this->value()) {
            return false;
        }

        return $this->currency()->matches($anotherMoney->currency());
    }

    /**
     * @param Money $anotherMoney
     * @return bool
     */
    public function isNotEqualTo(Money $anotherMoney): bool
    {
        return !$this->isEqualTo($anotherMoney);
    }

    /**
     * @param Currency $currency
     * @return bool
     */
    protected function currencyIsAllowed(Currency $currency): bool
    {
        return $this->currency()->doesNotMatch($currency);
    }
}
