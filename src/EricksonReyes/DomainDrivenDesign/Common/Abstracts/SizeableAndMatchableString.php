<?php


namespace EricksonReyes\DomainDrivenDesign\Common\Abstracts;

use EricksonReyes\DomainDrivenDesign\Common\Interfaces\CanCompareLength;
use EricksonReyes\DomainDrivenDesign\Common\Interfaces\CanMatchString;
use EricksonReyes\DomainDrivenDesign\Common\Interfaces\HasLength;

/**
 * Class SizeableAndMatchableString
 * @package EricksonReyes\DomainDrivenDesign\Common\Abstracts
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
abstract class SizeableAndMatchableString implements HasLength, CanCompareLength, CanMatchString
{

    /**
     * @var string
     */
    protected $string;

    public function __construct(string $string)
    {
        $string = trim($string);
        $this->string = $string;
    }

    /**
     * @param int $expectedLength
     * @return mixed
     */
    public function lengthIsEqualTo(int $expectedLength): bool
    {
        return $this->length() === $expectedLength;
    }

    /**
     * @param int $expectedLength
     * @return bool
     */
    public function lengthIsNotEqualTo(int $expectedLength): bool
    {
        return !$this->lengthIsEqualTo($expectedLength);
    }

    /**
     * @param int $expectedLength
     * @return mixed
     */
    public function lengthIsLessThan(int $expectedLength): bool
    {
        return $this->length() < $expectedLength;
    }

    /**
     * @param int $expectedLength
     * @return mixed
     */
    public function lengthIsGreaterThan(int $expectedLength): bool
    {
        return $this->length() > $expectedLength;
    }

    /**
     * @param int $expectedLength
     * @return mixed
     */
    public function lengthIsEqualOrLessThan(int $expectedLength): bool
    {
        return $this->length() <= $expectedLength;
    }

    /**
     * @param int $expectedLength
     * @return mixed
     */
    public function lengthIsEqualOrGreaterThan(int $expectedLength): bool
    {
        return $this->length() >= $expectedLength;
    }

    /**
     * @param string $keyword
     * @return bool
     */
    public function matches(string $keyword): bool
    {
        return strtolower($this->string) === strtolower($keyword);
    }

    /**
     * @param string $keyword
     * @return bool
     */
    public function doesNotMatch(string $keyword): bool
    {
        return !$this->matches($keyword);
    }

    /**
     * @param string $keyword
     * @return bool
     */
    public function contains(string $keyword): bool
    {
        return stripos($this->string, $keyword) !== false;
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
        $actual = strtolower(substr($this->string, 0, strlen($keyword)));
        $expected = strtolower($keyword);

        return $actual === $expected;
    }

    /**
     * @param string $keyword
     * @return bool
     */
    public function endsWith(string $keyword): bool
    {
        $actual = strtolower(substr($this->string, 0 - strlen($keyword)));
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
    public function doesNotEndWith(string $keyword): bool
    {
        return !$this->endsWith($keyword);
    }

    /**
     * @return int
     */
    public function length(): int
    {
        return strlen($this->string);
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->string;
    }
}
