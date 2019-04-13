<?php

namespace EricksonReyes\DomainDrivenDesign\Common\ValueObject;

use EricksonReyes\DomainDrivenDesign\Common\Attributes\ValueObject;

/**
 * Class FloatValue
 * @package EricksonReyes\DomainDrivenDesign\Common\ValueObject
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class FloatValue implements ValueObject
{
    /**
     * @var int
     */
    private $value;

    /**
     * FloatValue constructor.
     * @param float $value
     */
    public function __construct(float $value)
    {
        $this->value = $value;
    }

    /**
     * @return float
     */
    public function value(): float
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
     * @param FloatValue $anotherFloat
     * @return bool
     */
    public function isEqualTo(FloatValue $anotherFloat): bool
    {
        return $this->value() === $anotherFloat->value();
    }

    /**
     * @param FloatValue $anotherFloat
     * @return bool
     */
    public function isNotEqualTo(FloatValue $anotherFloat): bool
    {
        return !$this->isEqualTo($anotherFloat);
    }

    /**
     * @param FloatValue $anotherFloat
     * @return FloatValue
     */
    public function add(FloatValue $anotherFloat): self
    {
        return new FloatValue($this->value() + $anotherFloat->value());
    }

    /**
     * @param FloatValue $anotherFloat
     * @return FloatValue
     */
    public function subtract(FloatValue $anotherFloat): self
    {
        return new FloatValue($this->value() - $anotherFloat->value());
    }

    /**
     * @param FloatValue $anotherFloat
     * @return FloatValue
     */
    public function multiply(FloatValue $anotherFloat): self
    {
        return new FloatValue($this->value() * $anotherFloat->value());
    }

    /**
     * @param FloatValue $anotherFloat
     * @return FloatValue
     */
    public function divide(FloatValue $anotherFloat): self
    {
        return new FloatValue($this->value() / $anotherFloat->value());
    }

    /**
     * @param FloatValue $anotherFloat
     * @return bool
     */
    public function isLessThan(FloatValue $anotherFloat): bool
    {
        return $this->value() < $anotherFloat->value();
    }

    /**
     * @param FloatValue $anotherFloat
     * @return bool
     */
    public function isGreaterThan(FloatValue $anotherFloat): bool
    {
        return $this->value() > $anotherFloat->value();
    }
}
