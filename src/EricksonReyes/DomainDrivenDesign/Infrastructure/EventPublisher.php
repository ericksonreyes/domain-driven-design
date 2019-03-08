<?php

namespace EricksonReyes\DomainDrivenDesign\Infrastructure;

use EricksonReyes\DomainDrivenDesign\Domain\Event;

/**
 * Interface EventPublisher
 * @package EricksonReyes\DomainDrivenDesign\Infrastructure
 */
interface EventPublisher
{
    /**
     * @param Event $domainEvent
     */
    public function publish(Event $domainEvent): void;
}
