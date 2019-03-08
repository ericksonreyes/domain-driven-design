<?php

namespace EricksonReyes\DomainDrivenDesign;

use EricksonReyes\DomainDrivenDesign\Domain\Exception\MissingEventReplayMethodException;

/**
 * Class EventSourcedEntity
 * @package EricksonReyes\DomainDrivenDesign
 */
abstract class EventSourcedDomainEntity
{
    /**
     * @var DomainEvent[]
     */
    private $storedEvents = [];

    /**
     * @param DomainEvent $event
     */
    final protected function storeThis(DomainEvent $event): void
    {
        $this->storedEvents[] = $event;
    }

    /**
     * @return array
     */
    final public function storedEvents(): array
    {
        return $this->storedEvents;
    }

    final public function clearStoredEvents(): void
    {
        $this->storedEvents = [];
    }

    /**
     * @return bool
     */
    abstract public function isDeleted(): bool;

    /**
     * @param DomainEvent $domainEvent
     */
    public function replayThis(DomainEvent $domainEvent): void
    {
        $eventMethod = 'replay' . $domainEvent->eventName();
        if (method_exists($this, $eventMethod) === false) {
            throw new MissingEventReplayMethodException(
                'Missing domain event replay method ' . $eventMethod . '.'
            );
        }
        $this->$eventMethod($domainEvent);
    }
}
