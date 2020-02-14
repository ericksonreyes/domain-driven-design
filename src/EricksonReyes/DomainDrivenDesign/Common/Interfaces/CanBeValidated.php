<?php


namespace EricksonReyes\DomainDrivenDesign\Common\Interfaces;

/**
 * Interface HasValidity
 * @package EricksonReyes\DomainDrivenDesign\Common\Interfaces
 */
interface CanBeValidated
{

    /**
     * @return bool
     */
    public function isValid(): bool;

    /**
     * @return bool
     */
    public function isInvalid(): bool;
}
