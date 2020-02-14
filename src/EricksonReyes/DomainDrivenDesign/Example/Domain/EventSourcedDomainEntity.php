<?php

namespace EricksonReyes\DomainDrivenDesign\Example\Domain;

use DateTimeImmutable;
use EricksonReyes\DomainDrivenDesign\Common\ValueObject\Identifier;
use EricksonReyes\DomainDrivenDesign\Domain\Entity;
use EricksonReyes\DomainDrivenDesign\Domain\Event;
use EricksonReyes\DomainDrivenDesign\EventSourcedEntity;
use Exception;

/**
 * Class EventSourcedDomainEntity
 * @package EricksonReyes\DomainDrivenDesign\Example\Domain
 */
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
     * EventSourcedDomainEntity constructor.
     * @param Identifier $id
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
     * @param Entity $anotherEntity
     * @return bool
     */
    public function matches(Entity $anotherEntity): bool
    {
        return $this->id()->matches($anotherEntity->id());
    }

    /**
     * @param Entity $anotherEntity
     * @return bool
     */
    public function doesNotMatch(Entity $anotherEntity): bool
    {
        return !$this->matches($anotherEntity);
    }

    /**
     * @return string
     */
    public function additionalData(): string
    {
        return $this->additionalData;
    }

    /**
     * @throws Exception
     */
    public function delete(): void
    {
        $event = DomainEntityWasDeletedEvent::raise(
            (string) $this->id(),
            new DateTimeImmutable(),
            $this->additionalData()
        );

        if ($this->eventNeverHappened(DomainEntityWasDeletedEvent::class) &&
            $this->isTheFirstOccurrenceOfThis($event)
        ) {
            $this->storeAndReplayThis($event);
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
