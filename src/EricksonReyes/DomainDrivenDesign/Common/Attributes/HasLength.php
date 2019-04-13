<?php


namespace EricksonReyes\DomainDrivenDesign\Common\Attributes;

/**
 * Interface HasLength
 * @package EricksonReyes\DomainDrivenDesign\Common\Attributes
 */
interface HasLength
{

    /**
     * @return bool
     */
    public function isEmpty(): bool;

    /**
     * @return bool
     */
    public function isNotEmpty(): bool;

    /**
     * @return int
     */
    public function length(): int;

    /**
     * @param int $expectedLength
     * @return bool
     */
    public function lengthIsEqualTo(int $expectedLength): bool;

    /**
     * @param int $minimumLength
     * @return bool
     */
    public function lengthIsEqualOrGreaterThan(int $minimumLength): bool;

    /**
     * @param int $maximumLength
     * @return bool
     */
    public function lengthIsEqualOrLessThan(int $maximumLength): bool;
}
