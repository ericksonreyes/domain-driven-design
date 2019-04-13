<?php

namespace EricksonReyes\DomainDrivenDesign\Domain;

/**
 * Interface Entity
 * @package EricksonReyes\DomainDrivenDesign\Domain
 */
interface Entity
{
    /**
     * @return string
     */
    public function id(): string;

    /**
     * @return bool
     */
    public function isDeleted(): bool;
}
