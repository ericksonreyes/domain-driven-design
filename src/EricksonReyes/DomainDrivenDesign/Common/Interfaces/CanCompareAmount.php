<?php


namespace EricksonReyes\EricksonReyes\DomainDrivenDesign\Common\Interfaces;

/**
 * Interface HasComparableAmount
 * @package EricksonReyes\EricksonReyes\DomainDrivenDesign\Common\Interfaces
 */
interface CanCompareAmount
{
    /**
     * @param int $amount
     * @return bool
     */
    public function amountIsEqualsTo(int $amount): bool;

    /**
     * @param int $amount
     * @return bool
     */
    public function amountIsLessThan(int $amount): bool;

    /**
     * @param int $amount
     * @return bool
     */
    public function amountIsGreaterThan(int $amount): bool;

    /**
     * @param int $amount
     * @return bool
     */
    public function amountIsEqualOrLessThan(int $amount): bool;

    /**
     * @param int $amount
     * @return bool
     */
    public function amountIsEqualOrGreaterThan(int $amount): bool;
}