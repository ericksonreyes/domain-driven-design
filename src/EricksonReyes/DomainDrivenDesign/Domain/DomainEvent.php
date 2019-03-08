<?php

namespace EricksonReyes\DomainDrivenDesign;

use DateTimeImmutable;

/**
 * Interface DomainEvent
 * @package EricksonReyes\DomainDrivenDesign
 */
interface DomainEvent
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

    /**
     * @param array $array
     * @return DomainEvent
     */
    public static function fromArray(array $array): self;
}
