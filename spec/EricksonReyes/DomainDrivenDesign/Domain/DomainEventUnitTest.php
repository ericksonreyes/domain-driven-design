<?php

namespace spec\EricksonReyes\DomainDrivenDesign\Domain;

use DateTimeImmutable;
use Faker\Factory;
use Faker\Generator;
use PhpSpec\ObjectBehavior;

abstract class DomainEventUnitTest extends ObjectBehavior
{

    /**
     * @var string
     */
    protected $entityId;

    /**
     * @var string
     */
    protected $entityType;

    /**
     * @var string
     */
    protected $eventName;

    /**
     * @var string
     */
    protected $eventContext;

    /**
     * @var DateTimeImmutable;
     */
    protected $happenedOn;

    /**
     * @var Generator
     */
    protected $seeder;

    public function __construct()
    {
        $this->seeder = Factory::create();
    }

    public function it_has_event_name()
    {
        $this::staticEventName()->shouldReturn($this->eventName);
        $this->eventName()->shouldReturn($this->eventName);
    }

    public function it_belongs_to_a_domain_context()
    {
        $this::staticEntityContext()->shouldReturn($this->eventContext);
        $this->entityContext()->shouldReturn($this->eventContext);
    }

    public function it_belongs_to_an_domain_entity_type()
    {
        $this::staticEntityType()->shouldReturn($this->entityType);
        $this->entityType()->shouldReturn($this->entityType);
    }

    public function it_belongs_to_an_entity()
    {
        $this->entityId()->shouldReturn($this->entityId);
    }

    public function it_has_event_date()
    {
        $this->happenedOn()->shouldReturn($this->happenedOn);
    }

    abstract public function it_has_array_representation();

    abstract public function it_can_be_restored_from_array();
}