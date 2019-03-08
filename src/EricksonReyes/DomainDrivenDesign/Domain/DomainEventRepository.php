<?php

namespace EricksonReyes\DomainDrivenDesign;

/**
 * Interface DomainEventRepository
 * @package EricksonReyes\DomainDrivenDesign
 */
interface DomainEventRepository
{

    /**
     * @param DomainEvent $domainEvent
     * @return mixed
     */
    public function store(DomainEvent $domainEvent): void;


    /**
     * @param string $contextName
     * @param string $entityType
     * @param string $entityId
     * @return DomainEvent[]
     */
    public function getEventsFor(string $contextName, string $entityType, string $entityId): array;

    /**
     * @param $entityId
     * @return array|null
     */
    public function getEventsForId($entityId): ?array;
}
