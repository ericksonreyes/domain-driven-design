<?php


namespace EricksonReyes\EricksonReyes\DomainDrivenDesign\Common\Interfaces;

/**
 * Interface HasComparableLength
 * @package EricksonReyes\EricksonReyes\DomainDrivenDesign\Common\Interfaces
 */
interface HasComparableLength
{
    /**
     * @param int $expectedLength
     * @return mixed
     */
    public function lengthIsEqualTo(int $expectedLength);

    /**
     * @param int $limit
     * @return mixed
     */
    public function lengthIsLessThan(int $limit);

    /**
     * @param int $limit
     * @return mixed
     */
    public function lengthIsGreaterThan(int $limit);

    /**
     * @param int $limit
     * @return mixed
     */
    public function lengthIsEqualOrLessThan(int $limit);

    /**
     * @param int $limit
     * @return mixed
     */
    public function lengthIsEqualOrGreaterThan(int $limit);
}