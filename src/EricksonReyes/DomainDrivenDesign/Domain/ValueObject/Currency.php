<?php

namespace EricksonReyes\DomainDrivenDesign\Domain\ValueObject;

class Currency
{
    /**
     * @var Currency
     */
    private $value;

    /**
     * Currency constructor.
     * @param string $string
     */
    public function __construct(string $string)
    {
        $this->value = $string;
    }

    /**
     * @param string $string
     * @return Currency
     */
    public static function fromString(string $string): self
    {
        return new self($string);
    }

    /**
     * @return Currency
     */
    public function value(): string
    {
        return $this->value;
    }

    /**
     * @return bool
     */
    public function isEmpty(): bool
    {
        return trim($this->value()) === '';
    }

    /**
     * @param string $stringToCompareTo
     * @return bool
     */
    public function matches(string $stringToCompareTo): bool
    {
        return $this->value() === $stringToCompareTo;
    }

    /**
     * @param string $stringToCompareTo
     * @return bool
     */
    public function doesNotMatch(string $stringToCompareTo): bool
    {
        return $this->matches($stringToCompareTo) === false;
    }

    /**
     * @return bool
     */
    public function isNotEmpty(): bool
    {
        return $this->isEmpty() === false;
    }
}
