<?php


namespace EricksonReyes\DomainDrivenDesign\Common\Interfaces;

interface CanCompareSize
{
    /**
     * @param int $expectedSize
     * @return bool
     */
    public function sizeIsEqualTo(int $expectedSize): bool;

    /**
     * @param int $expectedSize
     * @return bool
     */
    public function sizeIsNotEqualTo(int $expectedSize): bool;

    /**
     * @param int $expectedSize
     * @return bool
     */
    public function sizeIsLessThan(int $expectedSize): bool;

    /**
     * @param int $expectedSize
     * @return bool
     */
    public function sizeIsGreaterThan(int $expectedSize): bool;

    /**
     * @param int $expectedSize
     * @return bool
     */
    public function sizeIsEqualOrLessThan(int $expectedSize): bool;

    /**
     * @param int $expectedSize
     * @return bool
     */
    public function sizeIsEqualOrGreaterThan(int $expectedSize): bool;
}
