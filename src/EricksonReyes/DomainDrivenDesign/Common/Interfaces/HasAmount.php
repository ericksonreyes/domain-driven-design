<?php


namespace EricksonReyes\EricksonReyes\DomainDrivenDesign\Common\Interfaces;

/**
 * Interface HasAmount
 * @package EricksonReyes\EricksonReyes\DomainDrivenDesign\Common\Interfaces
 */
interface HasAmount
{
    /**
     * @return int
     */
    public function amount(): int;
}
