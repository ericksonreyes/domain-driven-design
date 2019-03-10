<?php

namespace EricksonReyes\DomainDrivenDesign\Infrastructure;

use EricksonReyes\DomainDrivenDesign\Domain\Event;
use EricksonReyes\DomainDrivenDesign\Domain\ValueObject\Identifier;

/**
 * Interface EventRepository
 * @package EricksonReyes\DomainDrivenDesign\Infrastructure
 */
interface EventRepository
{

    /**
     * @param Event $domainEvent
     */
    public function store(Event $domainEvent): void;

    /**
     * @param string $eventId
     * @return Event
     */
    public function findById(string $eventId): ?Event;

    /**
     * @param Identifier $entityId
     * @return null|Event[]
     */
    public function findAllByEntityId(Identifier $entityId): ?array;
}
