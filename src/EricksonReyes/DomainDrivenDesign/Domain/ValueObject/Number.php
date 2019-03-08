<?php

namespace EricksonReyes\DomainDrivenDesign\Domain\ValueObject;

class Number
{

    /**
     * @var int
     */
    private $amount;

    /**
     * Number constructor.
     * @param int $amount
     */
    public function __construct(int $amount)
    {
        $this->amount = $amount;
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
     * @return Number
     */
    public function incrementBy(int $amount): self
    {
        $newAmount = $this->amount() + $amount;
        return new self($newAmount);
    }

    /**
     * @param int $amount
     * @return Number
     */
    public function decrementBy(int $amount): self
    {
        $newAmount = $this->amount() - $amount;
        return new self($newAmount);
    }

    /**
     * @param int $number
     * @return Number
     */
    public function multiplyBy(int $number): self
    {
        $newAmount = $this->amount() * $number;
        return new self($newAmount);
    }

    /**
     * @param int $number
     * @return Number
     */
    public function divideBy(int $number): self
    {
        $newAmount = $this->amount() / $number;
        return new self($newAmount);
    }
}
