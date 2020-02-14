<?php


namespace EricksonReyes\DomainDrivenDesign\Common\Interfaces;

/**
 * Interface HasAmount
 * @package EricksonReyes\DomainDrivenDesign\Common\Interfaces
 */
interface HasAmount
{
    /**
     * @return int
     */
    public function amount(): int;
}
