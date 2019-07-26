<?php

namespace EricksonReyes\DomainDrivenDesign\Domain;

/**
 * Interface AccountableEvent
 * @package EricksonReyes\DomainDrivenDesign\Domain
 */
interface AccountableEvent extends Event
{
    /**
     * @return string
     */
    public function raisedBy(): string;
}
