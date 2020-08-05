<?php


namespace EricksonReyes\DomainDrivenDesign\Common\Interfaces;

/**
 * Interface HasComparableLength
 * @package EricksonReyes\DomainDrivenDesign\Common\Interfaces
 */
interface CanCompareLength
{
    /**
     * @param int $expectedLength
     * @return bool
     */
    public function lengthIsEqualTo(int $expectedLength): bool;

    /**
     * @param int $expectedLength
     * @return bool
     */
    public function lengthIsNotEqualTo(int $expectedLength): bool;

    /**
     * @param int $expectedLength
     * @return bool
     */
    public function lengthIsLessThan(int $expectedLength): bool;

    /**
     * @param int $expectedLength
     * @return bool
     */
    public function lengthIsGreaterThan(int $expectedLength): bool;

    /**
     * @param int $expectedLength
     * @return bool
     */
    public function lengthIsEqualOrLessThan(int $expectedLength): bool;

    /**
     * @param int $expectedLength
     * @return bool
     */
    public function lengthIsEqualOrGreaterThan(int $expectedLength): bool;
}
