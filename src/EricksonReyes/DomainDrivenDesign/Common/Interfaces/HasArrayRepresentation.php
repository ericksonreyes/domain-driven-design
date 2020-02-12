<?php


namespace EricksonReyes\EricksonReyes\DomainDrivenDesign\Common\Interfaces;

/**
 * Interface HasArrayRepresentation
 * @package EricksonReyes\EricksonReyes\DomainDrivenDesign\Common\Interfaces
 */
interface HasArrayRepresentation
{
    /**
     * @return array
     */
    public function toArray(): array;

}