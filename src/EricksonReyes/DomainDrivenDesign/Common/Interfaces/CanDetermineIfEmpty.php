<?php


namespace EricksonReyes\DomainDrivenDesign\Common\Interfaces;

/**
 * Interface CanDetermineIfEmpty
 * @package EricksonReyes\DomainDrivenDesign\Common\Interfaces
 */
interface CanDetermineIfEmpty
{

    /**
     * @return bool
     */
    public function isEmpty(): bool;

    /**
     * @return bool
     */
    public function isNotEmpty(): bool;
}
