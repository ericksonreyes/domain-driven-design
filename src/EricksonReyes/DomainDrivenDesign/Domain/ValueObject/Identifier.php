<?php

namespace EricksonReyes\DomainDrivenDesign\Domain\ValueObject;

class Identifier
{
    use CanCompareStrings;

    /**
     * Text constructor.
     * @param string $string
     */
    public function __construct(string $string)
    {
        $this->value = $string;
    }

    /**
     * @param string $string
     * @return Identifier
     */
    public static function fromString(string $string): self
    {
        return new self($string);
    }
}
