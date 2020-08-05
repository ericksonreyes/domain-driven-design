<?php


namespace EricksonReyes\DomainDrivenDesign\Common\Interfaces;

/**
 * Interface CanBeValidated
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
