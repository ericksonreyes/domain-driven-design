<?php

namespace EricksonReyes\DomainDrivenDesign\Common\ValueObject;

use EricksonReyes\DomainDrivenDesign\Common\Attributes\ValueObject;

/**
 * Class IntegerValue
 * @package EricksonReyes\DomainDrivenDesign\Common\ValueObject
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class IntegerValue implements ValueObject
{
    /**
     * @var int
     */
    private $value;

    /**
     * IntegerValue constructor.
     * @param int $value
     */
    public function __construct(int $value)
    {
        $this->value = $value;
    }

    /**
     * @return int
     */
    public function value(): int
    {
        return $this->value;
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
     * @param IntegerValue $anotherInteger
     * @return bool
     */
    public function isEqualTo(IntegerValue $anotherInteger): bool
    {
        return $this->value() === $anotherInteger->value();
    }

    /**
     * @param IntegerValue $anotherInteger
     * @return bool
     */
    public function isNotEqualTo(IntegerValue $anotherInteger): bool
    {
        return !$this->isEqualTo($anotherInteger);
    }

    /**
     * @param IntegerValue $anotherInteger
     * @return IntegerValue
     */
    public function add(IntegerValue $anotherInteger): self
    {
        return new IntegerValue($this->value() + $anotherInteger->value());
    }

    /**
     * @param IntegerValue $anotherInteger
     * @return IntegerValue
     */
    public function subtract(IntegerValue $anotherInteger): self
    {
        return new IntegerValue($this->value() - $anotherInteger->value());
    }

    /**
     * @param IntegerValue $anotherInteger
     * @return IntegerValue
     */
    public function multiply(IntegerValue $anotherInteger): self
    {
        return new IntegerValue($this->value() * $anotherInteger->value());
    }

    /**
     * @param IntegerValue $anotherInteger
     * @return IntegerValue
     */
    public function divide(IntegerValue $anotherInteger): self
    {
        return new IntegerValue($this->value() / $anotherInteger->value());
    }

    /**
     * @param IntegerValue $anotherInteger
     * @return bool
     */
    public function isLessThan(IntegerValue $anotherInteger): bool
    {
        return $this->value() < $anotherInteger->value();
    }

    /**
     * @param IntegerValue $anotherInteger
     * @return bool
     */
    public function isGreaterThan(IntegerValue $anotherInteger): bool
    {
        return $this->value() > $anotherInteger->value();
    }
}
