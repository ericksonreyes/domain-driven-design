<?php

namespace EricksonReyes\DomainDrivenDesign\Domain\ValueObject;

class UnitOfMeasurement
{
    use CanCompareStrings;

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
     * @return UnitOfMeasurement
     */
    public static function fromString(string $string): self
    {
        return new self($string);
    }
}
