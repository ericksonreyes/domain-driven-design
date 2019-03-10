<?php

namespace spec\EricksonReyes\DomainDrivenDesign\Example;

use EricksonReyes\DomainDrivenDesign\Domain\Event;
use EricksonReyes\DomainDrivenDesign\Example\DomainEntityWasDeletedEvent;
use spec\EricksonReyes\DomainDrivenDesign\Domain\DomainEventUnitTest;

class DomainEntityWasDeletedEventSpec extends DomainEventUnitTest
{

    /**
     * @var string
     */
    private $additionalData;

    /**
     * @throws \Exception
     */
    public function let()
    {
        $this->eventName = 'DomainEntityWasDeleted';
        $this->eventContext = 'ExampleDomainContext';
        $this->entityId = $this->seeder->uuid;
        $this->entityType = 'ExampleDomainEntityType';
        $this->happenedOn = new \DateTimeImmutable();
        $this->additionalData = $this->seeder->paragraph;

        $this->beConstructedThrough('raise', [
            $this->entityId,
            $this->happenedOn,
            $this->additionalData
        ]);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(DomainEntityWasDeletedEvent::class);
        $this->shouldHaveType(Event::class);
    }

    public function it_can_have_additional_data()
    {
        $this->additionalData()->shouldReturn($this->additionalData);
    }

    public function it_has_array_representation()
    {
        $this->toArray()->shouldReturn(
            [
                'entityId' => $this->entityId,
                'happenedOn' => $this->happenedOn->getTimestamp(),
                'additionalData' => $this->additionalData
            ]
        );
    }

    public function it_can_be_restored_from_array()
    {
        $array = [
            'entityId' => $this->entityId,
            'happenedOn' => $this->happenedOn->getTimestamp(),
            'additionalData' => $this->additionalData
        ];
        $this::fromArray($array)->shouldHaveType(DomainEntityWasDeletedEvent::class);
        $this::fromArray($array)->entityId()->shouldReturn($this->entityId);
        $this::fromArray($array)->happenedOn()->getTimestamp()->shouldReturn($this->happenedOn->getTimestamp());
        $this::fromArray($array)->additionalData()->shouldReturn($this->additionalData);
    }
}
