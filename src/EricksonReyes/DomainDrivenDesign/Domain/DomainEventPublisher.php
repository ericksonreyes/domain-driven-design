<?php

namespace EricksonReyes\DomainDrivenDesign;

/**
 * Interface DomainEventPublisher
 * @package EricksonReyes\DomainDrivenDesign
 */
interface DomainEventPublisher
{
    /**
     * @param DomainEvent $domainEvent
     */
    public function publish(DomainEvent $domainEvent): void;
}
