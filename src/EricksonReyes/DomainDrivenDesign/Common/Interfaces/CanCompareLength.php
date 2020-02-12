<?php


namespace EricksonReyes\EricksonReyes\DomainDrivenDesign\Common\Interfaces;

/**
 * Interface HasComparableLength
 * @package EricksonReyes\EricksonReyes\DomainDrivenDesign\Common\Interfaces
 */
interface CanCompareLength
{
    /**
     * @param int $length
     * @return mixed
     */
    public function lengthIsEqualTo(int $length);

    /**
     * @param int $length
     * @return mixed
     */
    public function lengthIsLessThan(int $length);

    /**
     * @param int $length
     * @return mixed
     */
    public function lengthIsGreaterThan(int $length);

    /**
     * @param int $length
     * @return mixed
     */
    public function lengthIsEqualOrLessThan(int $length);

    /**
     * @param int $length
     * @return mixed
     */
    public function lengthIsEqualOrGreaterThan(int $length);
}