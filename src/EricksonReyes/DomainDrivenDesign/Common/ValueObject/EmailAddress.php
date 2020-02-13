<?php

namespace EricksonReyes\DomainDrivenDesign\Common\ValueObject;

use EricksonReyes\EricksonReyes\DomainDrivenDesign\Common\Interfaces\CanCompareLength;
use EricksonReyes\EricksonReyes\DomainDrivenDesign\Common\Interfaces\CanMatchString;
use EricksonReyes\EricksonReyes\DomainDrivenDesign\Common\Interfaces\HasLength;
use EricksonReyes\EricksonReyes\DomainDrivenDesign\Common\ValueObject\Exception\InvalidEmailAddressException;

/**
 * Class EmailAddress
 * @package EricksonReyes\DomainDrivenDesign\Common\ValueObject
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class EmailAddress implements CanCompareLength, HasLength, CanMatchString
{
    /**
     * @var
     */
    private $emailAddress;

    public function __construct(string $emailAddress)
    {
        $trimmedEmailAddress = trim($emailAddress);
        if ($this->emailIsInValid($emailAddress)) {
            throw new InvalidEmailAddressException($trimmedEmailAddress . ' is not a valid e-mail address.');
        }
        $this->emailAddress = $trimmedEmailAddress;
    }

    /**
     * @param int $length
     * @return mixed
     */
    public function lengthIsEqualTo(int $length)
    {
        return $this->length() === $length;
    }

    /**
     * @param int $length
     * @return mixed
     */
    public function lengthIsLessThan(int $length)
    {
        return $this->length() < $length;
    }

    /**
     * @param int $length
     * @return mixed
     */
    public function lengthIsGreaterThan(int $length)
    {
        return $this->length() > $length;
    }

    /**
     * @param int $length
     * @return mixed
     */
    public function lengthIsEqualOrLessThan(int $length)
    {
        return $this->length() <= $length;
    }

    /**
     * @param int $length
     * @return mixed
     */
    public function lengthIsEqualOrGreaterThan(int $length)
    {
        return $this->length() >= $length;
    }

    /**
     * @return int
     */
    public function length(): int
    {
        return strlen($this->emailAddress);
    }

    /**
     * @param string $emailAddress
     * @return bool
     */
    public function matches(string $emailAddress): bool
    {
        return strtolower($this->emailAddress) === strtolower($emailAddress);
    }

    /**
     * @param string $emailAddress
     * @return bool
     */
    public function doesNotMatch(string $emailAddress): bool
    {
        return !$this->matches($emailAddress);
    }

    /**
     * @param string $keyword
     * @return bool
     */
    public function contains(string $keyword): bool
    {
        return stripos($this->emailAddress, $keyword) !== false;
    }

    /**
     * @param string $keyword
     * @return bool
     */
    public function doesNotContain(string $keyword): bool
    {
        return !$this->contains($keyword);
    }

    /**
     * @param string $keyword
     * @return bool
     */
    public function startsWith(string $keyword): bool
    {
        $actual = strtolower(substr($this->emailAddress, 0, strlen($keyword)));
        $expected = strtolower($keyword);

        return $actual === $expected;
    }

    /**
     * @param string $keyword
     * @return bool
     */
    public function doesNotStartWith(string $keyword): bool
    {
        return !$this->startsWith($keyword);
    }

    /**
     * @param string $keyword
     * @return bool
     */
    public function endsWith(string $keyword): bool
    {
        $actual = strtolower(substr($this->emailAddress, 0 - strlen($keyword)));
        $expected = strtolower($keyword);

        return $actual === $expected;
    }

    /**
     * @param string $keyword
     * @return bool
     */
    public function doesNotEndWith(string $keyword): bool
    {
        return !$this->endsWith($keyword);
    }

    /**
     * @return string
     */
    public function username(): string
    {
        return explode('@', $this->emailAddress)[0];
    }

    /**
     * @return string
     */
    public function domain(): string
    {
        return explode('@', $this->emailAddress)[1];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->emailAddress;
    }

    /**
     * @param string $emailAddress
     * @return bool
     */
    private function emailIsInValid(string $emailAddress): bool
    {
        $pattern = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$^";
        return (bool)preg_match($pattern, $emailAddress) === false;
    }
}
