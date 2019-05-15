<?php

namespace EricksonReyes\DomainDrivenDesign\Example;

use DateTimeImmutable;
use EricksonReyes\DomainDrivenDesign\Domain\Event;
use EricksonReyes\DomainDrivenDesign\EventSourcedEntity;

/**
 * Class EventSourcedDomainEntity
 * @package EricksonReyes\DomainDrivenDesign\Example
 */
class EventSourcedDomainEntity extends EventSourcedEntity
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $additionalData = '';

    /**
     * @var bool
     */
    private $deleted = false;

    /**
     * @var DateTimeImmutable
     */
    private $deletedOn;

    /**
     * DomainEntity constructor.
     * @param $id
     */
    public function __construct(string $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function id(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function additionalData(): string
    {
        return $this->additionalData;
    }

    /**
     * @return bool
     */
    public function isDeleted(): bool
    {
        return $this->deleted;
    }

    /**
     * @throws \Exception
     */
    public function delete(): void
    {
        $event = DomainEntityWasDeletedEvent::raise(
            $this->id(),
            new DateTimeImmutable(),
            $this->additionalData()
        );

        if ($this->eventNeverHappened(DomainEntityWasDeletedEvent::class)) {
            if ($this->isTheFirstOccurrenceOfThis($event)) {
                $this->storeAndReplayThis($event);
            }
        }

        if (!$this->isTheFirstOccurrenceOfThis($event)) {
            return;
        }
    }

    /**
     * @param Event $event
     */
    public function restoreFromEvent(Event $event): void
    {
        $this->replayThis($event);
    }

    /**
     * @param DomainEntityWasDeletedEvent $event
     */
    protected function replayDomainEntityWasDeleted(DomainEntityWasDeletedEvent $event): void
    {
        $this->deletedOn = $event->happenedOn();
        $this->deleted = true;
    }
}
