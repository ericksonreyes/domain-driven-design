<?php

namespace EricksonReyes\DomainDrivenDesign;

use EricksonReyes\DomainDrivenDesign\Domain\Entity;
use EricksonReyes\DomainDrivenDesign\Domain\Event;
use EricksonReyes\DomainDrivenDesign\Domain\Exception\MissingEventReplayMethodException;

/**
 * Class EventSourcedEntity
 * @package EricksonReyes\DomainDrivenDesign
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
            throw new MissingEventReplayMethodException(
                'Missing domain event replay method ' . $eventMethod . '.'
            );
        }
        $this->$eventMethod($domainEvent);
    }

    /**
     * @param Event $event
     */
    final protected function storeThis(Event $event): void
    {
        $this->storedEvents[] = $event;
    }
}
