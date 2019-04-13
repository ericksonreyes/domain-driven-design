<?php

namespace EricksonReyes\DomainDrivenDesign\Common\ValueObject;

use EricksonReyes\DomainDrivenDesign\Common\Attributes\HasLength;
use EricksonReyes\DomainDrivenDesign\Common\Attributes\HasValue;
use EricksonReyes\DomainDrivenDesign\Common\Attributes\ValueObject;
use EricksonReyes\DomainDrivenDesign\Common\ValueObject\Exception\InvalidEmailException;

/**
 * Class Email
 * @package EricksonReyes\DomainDrivenDesign\Common\ValueObject
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class Email implements ValueObject, HasValue, HasLength
{

    /**
     * @var string
     */
    private $value;

    public function __construct(string $email)
    {
        $this->value = trim($email);

        if ($this->isNotAValidEmail()) {
            throw new InvalidEmailException('"' . $this->value() . '" is not a valid email.');
        }
    }

    /**
     * @return string
     */
    public function value(): string
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

    public function __toString(): string
    {
        return $this->value();
    }

    /**
     * @param Email $anotherEmail
     * @return bool
     */
    public function matches(Email $anotherEmail): bool
    {
        return $anotherEmail->value() === $this->value();
    }

    /**
     * @param Email $anotherEmail
     * @return bool
     */
    public function doesNotMatch(Email $anotherEmail): bool
    {
        return !$this->matches($anotherEmail);
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
     * @return bool
     */
    private function isNotAValidEmail(): bool
    {
        return !filter_var($this->value(), FILTER_VALIDATE_EMAIL);
    }
}
