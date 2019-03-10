<?php

namespace EricksonReyes\DomainDrivenDesign\Example;

use DateTimeImmutable;
use EricksonReyes\DomainDrivenDesign\Domain\Event;
use EricksonReyes\DomainDrivenDesign\Domain\ValueObject\Identifier;
use EricksonReyes\DomainDrivenDesign\EventSourcedEntity;

class EventSourcedDomainEntity extends EventSourcedEntity
{
    /**
     * @var Identifier
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
    public function __construct(Identifier $id)
    {
        $this->id = $id;
    }

    /**
     * @return Identifier
     */
    public function id(): Identifier
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
            $this->id()->value(),
            new DateTimeImmutable(),
            $this->additionalData()
        );

        $this->storeThis($event);
        $this->replayThis($event);
    }

    /**
     * @throws \Exception
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