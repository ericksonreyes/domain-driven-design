<?php


namespace EricksonReyes\DomainDrivenDesign\Common\Interfaces;

/**
 * Interface HasComparableAmount
 * @package EricksonReyes\DomainDrivenDesign\Common\Interfaces
 */
interface CanCompareAmount
{
    /**
     * @param int $expectedAmount
     * @return bool
     */
    public function amountIsEqualsTo(int $expectedAmount): bool;

    /**
     * @param int $expectedAmount
     * @return bool
     */
    public function amountIsNotEqualTo(int $expectedAmount): bool;

    /**
     * @param int $expectedAmount
     * @return bool
     */
    public function amountIsLessThan(int $expectedAmount): bool;

    /**
     * @param int $expectedAmount
     * @return bool
     */
    public function amountIsGreaterThan(int $expectedAmount): bool;

    /**
     * @param int $expectedAmount
     * @return bool
     */
    public function amountIsEqualOrLessThan(int $expectedAmount): bool;

    /**
     * @param int $expectedAmount
     * @return bool
     */
    public function amountIsEqualOrGreaterThan(int $expectedAmount): bool;
}
