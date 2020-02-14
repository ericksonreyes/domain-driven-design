<?php

namespace EricksonReyes\DomainDrivenDesign;

use EricksonReyes\DomainDrivenDesign\Common\Exception\DomainEventOwnershipError;
use EricksonReyes\DomainDrivenDesign\Common\Exception\MissingEventReplayMethodError;
use EricksonReyes\DomainDrivenDesign\Domain\Entity;
use EricksonReyes\DomainDrivenDesign\Domain\Event;

/**
 * Class EventSourcedEntity
 * @package DomainDrivenDesign
 */
abstract class EventSourcedEntity implements Entity
{

    /**
     * @var Event[]
     */
    private $storedEvents = [];

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
     * @param Event $domainEvent
     */
    public function replayThis(Event $domainEvent): void
    {
        $eventMethod = 'replay' . $domainEvent->eventName();
        if (method_exists($this, $eventMethod) === false) {
            throw new MissingEventReplayMethodError(
                'Missing domain event replay method ' . $eventMethod . '.'
            );
        }

        if ($this->id()->doesNotMatch($domainEvent->entityId())) {
            throw new DomainEventOwnershipError(
                'This entity does not own this ' . $domainEvent->eventName() . ' domain event.'
            );
        }
        $this->$eventMethod($domainEvent);
    }

    /**
     * @param Event $event
     * @return bool
     */
    final public function isTheFirstOccurrenceOfThis(Event $event): bool
    {
        foreach ($this->storedEvents() as $storedEvent) {
            if ($storedEvent instanceof $event) {
                return false;
            }
        }

        return true;
    }

    /**
     * @param string $eventClassName
     * @return bool
     */
    final public function eventAlreadyHappened(string $eventClassName): bool
    {
        foreach ($this->storedEvents() as $storedEvent) {
            if ($storedEvent instanceof $eventClassName) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param string $eventClassName
     * @return bool
     */
    final public function eventNeverHappened(string $eventClassName): bool
    {
        return !$this->eventAlreadyHappened($eventClassName);
    }

    /**
     * @param Event $event
     */
    final protected function storeThis(Event $event): void
    {
        $this->storedEvents[] = $event;
    }

    /**
     * @param Event $event
     */
    final protected function storeAndReplayThis(Event $event): void
    {
        $this->storeThis($event);
        $this->replayThis($event);
    }
}
