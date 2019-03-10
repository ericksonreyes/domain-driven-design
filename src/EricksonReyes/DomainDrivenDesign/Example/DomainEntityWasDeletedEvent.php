<?php

namespace EricksonReyes\DomainDrivenDesign\Example;

use DateTime;
use DateTimeImmutable;
use EricksonReyes\DomainDrivenDesign\Domain\Event;

/**
 * Class DomainEvent
 * @package EricksonReyes\DomainDrivenDesign\Example
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class DomainEntityWasDeletedEvent implements Event
{
    /**
     * @var string
     */
    private $entityId;

    /**
     * @var \DateTimeImmutable;
     */
    private $happenedOn;

    /**
     * @var string
     */
    private $additionalData;

    /**
     * DomainEvent constructor.
     * @param string $entityId
     * @param DateTimeImmutable $happenedOn
     * @param string $additionalData
     */
    public function __construct(string $entityId, DateTimeImmutable $happenedOn, string $additionalData)
    {
        $this->entityId = $entityId;
        $this->happenedOn = $happenedOn;
        $this->additionalData = $additionalData;
    }

    /**
     * @param string $entityId
     * @param DateTimeImmutable $happenedOn
     * @param string $additionalData
     * @return DomainEntityWasDeletedEvent
     */
    public static function raise(string $entityId, DateTimeImmutable $happenedOn, string $additionalData): self
    {
        return new self($entityId, $happenedOn, $additionalData);
    }

    /**
     * @return string
     */
    public static function staticEventName(): string
    {
        return 'DomainEntityWasDeleted';
    }

    /**
     * @return string
     */
    public static function staticEntityContext(): string
    {
        return 'ExampleDomainContext';
    }

    /**
     * @return string
     */
    public static function staticEntityType(): string
    {
        return 'ExampleDomainEntityType';
    }

    /**
     * @param array $array
     * @return Event
     */
    public static function fromArray(array $array): Event
    {
        return self::raise(
            $array['entityId'],
            DateTimeImmutable::createFromMutable(
                (new DateTime())->setTimestamp($array['happenedOn'])
            ),
            $array['additionalData']
        );
    }

    /**
     * @return DateTimeImmutable
     */
    public function happenedOn(): DateTimeImmutable
    {
        return $this->happenedOn;
    }

    /**
     * @return string
     */
    public function eventName(): string
    {
        return self::staticEventName();
    }

    /**
     * @return string
     */
    public function entityContext(): string
    {
        return self::staticEntityContext();
    }

    /**
     * @return string
     */
    public function entityType(): string
    {
        return self::staticEntityType();
    }

    /**
     * @return string
     */
    public function entityId(): string
    {
        return $this->entityId;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'entityId' => $this->entityId,
            'happenedOn' => $this->happenedOn->getTimestamp(),
            'additionalData' => $this->additionalData
        ];
    }

    /**
     * @return string
     */
    public function additionalData(): string
    {
        return $this->additionalData;
    }
}
