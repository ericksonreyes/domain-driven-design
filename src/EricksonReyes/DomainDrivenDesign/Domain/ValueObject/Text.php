<?php

namespace EricksonReyes\DomainDrivenDesign\Domain\ValueObject;

class Text
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
     * @param string $string $string
     * @return Text
     */
    public static function fromString(string $string): self
    {
        return new self($string);
    }
}
