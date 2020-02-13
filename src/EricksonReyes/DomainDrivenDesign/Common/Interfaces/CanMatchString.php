<?php


namespace EricksonReyes\EricksonReyes\DomainDrivenDesign\Common\Interfaces;

/**
 * Interface HasComparableString
 * @package EricksonReyes\EricksonReyes\DomainDrivenDesign\Common\Interfaces
 */
interface CanMatchString
{

    /**
     * @param string $keyword
     * @return bool
     */
    public function matches(string $keyword): bool;

    /**
     * @param string $keyword
     * @return bool
     */
    public function doesNotMatch(string $keyword): bool;

    /**
     * @param string $keyword
     * @return bool
     */
    public function contains(string $keyword): bool;

    /**
     * @param string $keyword
     * @return bool
     */
    public function doesNotContain(string $keyword): bool;

    /**
     * @param string $keyword
     * @return bool
     */
    public function startsWith(string $keyword): bool;

    /**
     * @param string $keyword
     * @return bool
     */
    public function endsWith(string $keyword): bool;

    /**
     * @param string $keyword
     * @return bool
     */
    public function doesNotStartWith(string $keyword): bool;

    /**
     * @param string $keyword
     * @return bool
     */
    public function doesNotEndWith(string $keyword): bool;
}
