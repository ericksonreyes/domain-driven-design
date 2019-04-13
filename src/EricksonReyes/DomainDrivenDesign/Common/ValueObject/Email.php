<?php

namespace EricksonReyes\DomainDrivenDesign\Common\ValueObject;

use EricksonReyes\DomainDrivenDesign\Common\Attributes\HasValue;
use EricksonReyes\DomainDrivenDesign\Common\Attributes\IsString;
use EricksonReyes\DomainDrivenDesign\Common\Attributes\ValueObject;
use EricksonReyes\DomainDrivenDesign\Common\ValueObject\Exception\InvalidEmailException;

/**
 * Class Email
 * @package EricksonReyes\DomainDrivenDesign\Common\ValueObject
 */
class Email implements ValueObject, HasValue
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
    private function isNotAValidEmail(): bool
    {
        return !filter_var($this->value(), FILTER_VALIDATE_EMAIL);
    }
}
