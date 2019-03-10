<?php

namespace spec\EricksonReyes\DomainDrivenDesign\Example;

use EricksonReyes\DomainDrivenDesign\Domain\Event;
use EricksonReyes\DomainDrivenDesign\Example\DomainEntityWasDeletedEvent;
use Faker\Factory;
use Faker\Generator;
use PhpSpec\ObjectBehavior;

class DomainEntityWasDeletedEventSpec extends ObjectBehavior
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
     * @var Generator
     */
    private $seeder;

    public function __construct()
    {
        $this->seeder = Factory::create();
    }

    /**
     * @throws \Exception
     */
    public function let()
    {
        $this->beConstructedThrough('raise', [
            $this->entityId = $this->seeder->uuid,
            $this->happenedOn = new \DateTimeImmutable(),
            $this->additionalData = $this->seeder->paragraph
        ]);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(DomainEntityWasDeletedEvent::class);
        $this->shouldHaveType(Event::class);
    }

    public function it_has_event_name()
    {
        $this::staticEventName()->shouldReturn('DomainEntityWasDeleted');
        $this->eventName()->shouldReturn('DomainEntityWasDeleted');
    }

    public function it_belongs_to_a_domain_context()
    {
        $this::staticEntityContext()->shouldReturn('ExampleDomainContext');
        $this->entityContext()->shouldReturn('ExampleDomainContext');
    }

    public function it_belongs_to_an_domain_entity_type()
    {
        $this::staticEntityType()->shouldReturn('ExampleDomainEntityType');
        $this->entityType()->shouldReturn('ExampleDomainEntityType');
    }

    public function it_has_event_date()
    {
        $this->happenedOn()->shouldReturn($this->happenedOn);
    }

    public function it_belongs_to_an_entity()
    {
        $this->entityId()->shouldReturn($this->entityId);
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
