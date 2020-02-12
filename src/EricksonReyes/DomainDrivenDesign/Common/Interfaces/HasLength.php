<?php


namespace EricksonReyes\EricksonReyes\DomainDrivenDesign\Common\Interfaces;

/**
 * Interface HasLength
 * @package EricksonReyes\EricksonReyes\DomainDrivenDesign\Common\Interfaces
 */
interface HasLength
{

    /**
     * @return int
     */
    public function length(): int;
}