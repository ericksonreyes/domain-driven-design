<?php

namespace EricksonReyes\DomainDrivenDesign\Infrastructure;

use EricksonReyes\DomainDrivenDesign\Domain\Event;

/**
 * Interface EventRepository
 * @package EricksonReyes\DomainDrivenDesign\Infrastructure
 */
interface EventRepository
{

    /**
     * @param Event $domainEvent
     * @return mixed
     */
    public function store(Event $domainEvent): void;


    /**
     * @param string $contextName
     * @param string $entityType
     * @param string $entityId
     * @return Event[]
     */
    public function getEventsFor(string $contextName, string $entityType, string $entityId): array;

    /**
     * @param $entityId
     * @return array|null
     */
    public function getEventsForId($entityId): ?array;
}
