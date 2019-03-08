<?php

namespace EricksonReyes\DomainDrivenDesign\Domain\ValueObject;

class Currency
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
     * @return Currency
     */
    public static function fromString(string $string): self
    {
        return new self($string);
    }
}
