<?php


namespace EricksonReyes\DomainDrivenDesign\Common\Interfaces;

/**
 * Interface HasArrayRepresentation
 * @package EricksonReyes\DomainDrivenDesign\Common\Interfaces
 */
interface HasArrayRepresentation
{
    /**
     * @return array
     */
    public function toArray(): array;
}
