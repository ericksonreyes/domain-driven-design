<?php
namespace EricksonReyes\DomainDrivenDesign\Domain\ValueObject;

trait CanCompareStrings
{
    /**
     * @var Text
     */
    protected $value;

    /**
     * @return Text
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
