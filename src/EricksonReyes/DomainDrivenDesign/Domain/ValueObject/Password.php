<?php

namespace EricksonReyes\DomainDrivenDesign\Domain\ValueObject;

class Password extends Text
{
    /**
     * @param int $expectedLength
     * @return bool
     */
    public function lengthIsLessThan(int $expectedLength): bool
    {
        return strlen($this->value()) < $expectedLength;
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
     * @param int $expectedLength
     * @return bool
     */
    public function lengthIsGreaterThan(int $expectedLength): bool
    {
        return strlen($this->value()) > $expectedLength;
    }


    /**
     * @param int $expectedLength
     * @return bool
     */
    public function lengthIsLessThanOrEqualTo(int $expectedLength): bool
    {
        return strlen($this->value()) <= $expectedLength;
    }

    /**
     * @param int $expectedLength
     * @return bool
     */
    public function lengthIsGreaterThanOrEqualTo(int $expectedLength): bool
    {
        return strlen($this->value()) >= $expectedLength;
    }

    /**
     * @return bool
     */
    public function containsLettersAndNumbers(): bool
    {
        $hasALetter = preg_match('/[a-zA-Z]/', $this->value());
        $hasANumber = preg_match('/\d/', $this->value());
        return $hasALetter && $hasANumber;
    }

    /**
     * @return bool
     */
    public function doesNotContainLettersAndNumbers(): bool
    {
        return $this->containsLettersAndNumbers() === false;
    }
}
