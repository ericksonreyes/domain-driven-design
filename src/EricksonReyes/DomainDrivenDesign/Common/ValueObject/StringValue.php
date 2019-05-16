<?php

namespace EricksonReyes\DomainDrivenDesign\Common\ValueObject;

use EricksonReyes\DomainDrivenDesign\Common\Attributes\HasLength;
use EricksonReyes\DomainDrivenDesign\Common\Attributes\ValueObject;

/**
 * Class StringValue
 * @package EricksonReyes\DomainDrivenDesign\Common\ValueObject
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class StringValue implements ValueObject, HasLength
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

    /**
     * @return bool
     */
    public function isEmpty(): bool
    {
        return $this->value() === '';
    }

    /**
     * @return bool
     */
    public function isNotEmpty(): bool
    {
        return $this->value() !== '';
    }

    /**
     * @return int
     */
    public function length(): int
    {
        return strlen($this->value());
    }

    /**
     * @param int $expectedLength
     * @return bool
     */
    public function lengthIsEqualTo(int $expectedLength): bool
    {
        return strlen($this->value()) === $expectedLength;
    }

    /**
     * @param int $minimumLength
     * @return bool
     */
    public function lengthIsEqualOrGreaterThan(int $minimumLength): bool
    {
        return strlen($this->value()) >= $minimumLength;
    }

    /**
     * @param int $maximumLength
     * @return bool
     */
    public function lengthIsEqualOrLessThan(int $maximumLength): bool
    {
        return strlen($this->value()) <= $maximumLength;
    }

    /**
     * @return string
     */
    public function lowerCased(): string
    {
        return strtolower($this->value());
    }

    /**
     * @return string
     */
    public function upperCased(): string
    {
        return strtoupper($this->value());
    }

    /**
     * @return string
     */
    public function sentenceCased(): string
    {
        return ucfirst($this->value());
    }

    /**
     * @return string
     */
    public function titleCased(): string
    {
        return ucwords($this->value());
    }

    /**
     * @param string $keyword
     * @return bool
     */
    public function contains(string $keyword): bool
    {
        return strpos($this->value(), $keyword) !== false;
    }

    /**
     * @param string $keyword
     * @return bool
     */
    public function doesNotContain(string $keyword): bool
    {
        return $this->contains($keyword) === false;
    }
}
