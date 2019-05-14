<?php

namespace spec\EricksonReyes\DomainDrivenDesign\Example;


use DateTimeImmutable;
use EricksonReyes\DomainDrivenDesign\Domain\Event;

class MockDomainEvent implements Event
{
    /**
     * @var string
     */
    private $entityId;

    /**
     * MockDomainEvent constructor.
     * @param string $entityId
     */
    public function __construct(string $entityId)
    {
        $this->entityId = $entityId;
    }


    public static function staticEventName(): string
    {
        return '';
    }

    public static function staticEntityContext(): string
    {
        return '';
    }

    public static function staticEntityType(): string
    {
        return '';
    }

    public static function fromArray(array $array): Event
    {
        return new self;
    }

    /**
     * @return DateTimeImmutable
     * @throws \Exception
     */
    public function happenedOn(): DateTimeImmutable
    {
        return new DateTimeImmutable();
    }

    public function eventName(): string
    {
        return '';
    }

    public function entityContext(): string
    {
        return '';
    }

    public function entityType(): string
    {
        return '';
    }

    public function entityId(): string
    {
        return $this->entityId;
    }

    public function toArray(): array
    {
        return [];
    }
}