<?php

namespace EricksonReyes\DomainDrivenDesign\Domain;

use DateTimeImmutable;

/**
 * Interface DomainEvent
 * @package DomainDrivenDesign
 */
interface Event
{
    /**
     * @return string
     */
    public static function staticEventName(): string;

    /**
     * @return string
     */
    public static function staticEntityContext(): string;

    /**
     * @return string
     */
    public static function staticEntityType(): string;

    /**
     * @param array $array
     * @return Event
     */
    public static function fromArray(array $array): self;

    /**
     * @return DateTimeImmutable
     */
    public function happenedOn(): DateTimeImmutable;

    /**
     * @return string
     */
    public function eventName(): string;

    /**
     * @return string
     */
    public function entityContext(): string;

    /**
     * @return string
     */
    public function entityType(): string;

    /**
     * @return string
     */
    public function entityId(): string;

    /**
     * @return array
     */
    public function toArray(): array;
}
