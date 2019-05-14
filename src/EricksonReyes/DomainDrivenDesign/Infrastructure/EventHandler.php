<?php

namespace EricksonReyes\DomainDrivenDesign\Infrastructure;

use EricksonReyes\DomainDrivenDesign\Domain\Event;

/**
 * Interface EventHandler
 * @package EricksonReyes\DomainDrivenDesign\Infrastructure
 */
interface EventHandler
{

    /**
     * @return string
     */
    public function name(): string;

    /**
     * @param Event $event
     * @return bool
     */
    public function isInterestedInThis(Event $event): bool;

    /**
     * @param Event $event
     */
    public function beNotifiedAbout(Event $event): void;
}
