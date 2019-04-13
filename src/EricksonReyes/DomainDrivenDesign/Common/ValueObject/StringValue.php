<?php

namespace EricksonReyes\DomainDrivenDesign\Common\ValueObject;

use EricksonReyes\DomainDrivenDesign\Common\Attributes\ValueObject;

/**
 * Class StringValue
 * @package EricksonReyes\DomainDrivenDesign\Common\ValueObject
 */
class StringValue implements ValueObject
{
    /**
     * @var string
     */
    private $value;

    /**
     * StringValue constructor.
     * @param string $value
     */
    public function __construct(string $value)
    {
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->value();
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return trim($this->value);
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'value' => $this->value()
        ];
    }

    /**
     * @param StringValue $anotherString
     * @return bool
     */
    public function matches(StringValue $anotherString): bool
    {
        return $this->value() === $anotherString->value();
    }

    /**
     * @param StringValue $anotherString
     * @return bool
     */
    public function doesNotMatch(StringValue $anotherString): bool
    {
        return !$this->matches($anotherString);
    }
}
