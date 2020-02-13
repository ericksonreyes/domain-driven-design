<?php


namespace EricksonReyes\DomainDrivenDesign\Common\Interfaces;

/**
 * Interface HasComparableLength
 * @package EricksonReyes\DomainDrivenDesign\Common\Interfaces
 */
interface CanCompareLength
{
    /**
     * @param int $length
     * @return bool
     */
    public function lengthIsEqualTo(int $length): bool;

    /**
     * @param int $length
     * @return bool
     */
    public function lengthIsLessThan(int $length): bool;

    /**
     * @param int $length
     * @return bool
     */
    public function lengthIsGreaterThan(int $length): bool;

    /**
     * @param int $length
     * @return bool
     */
    public function lengthIsEqualOrLessThan(int $length): bool;

    /**
     * @param int $length
     * @return bool
     */
    public function lengthIsEqualOrGreaterThan(int $length): bool;
}
