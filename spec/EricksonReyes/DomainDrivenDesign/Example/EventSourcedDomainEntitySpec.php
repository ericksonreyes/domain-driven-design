<?php

namespace spec\EricksonReyes\DomainDrivenDesign\Example;

use DateTimeImmutable;
use EricksonReyes\DomainDrivenDesign\Domain\Entity;
use EricksonReyes\DomainDrivenDesign\Domain\Event;
use EricksonReyes\DomainDrivenDesign\Domain\Exception\MissingEventReplayMethodException;
use EricksonReyes\DomainDrivenDesign\Domain\ValueObject\Identifier;
use EricksonReyes\DomainDrivenDesign\EventSourcedEntity;
use EricksonReyes\DomainDrivenDesign\Example\DomainEntityWasDeletedEvent;
use EricksonReyes\DomainDrivenDesign\Example\EventSourcedDomainEntity;
use Faker\Factory;
use Faker\Generator;
use PhpSpec\ObjectBehavior;

class EventSourcedDomainEntitySpec extends ObjectBehavior
{
    /**
     * @var Identifier
     */
    private $id;

    /**
     * @var Generator
     */
    private $seeder;

    public function __construct()
    {
        $this->seeder = Factory::create();
    }

    public function let()
    {
        $this->beConstructedWith(
            $this->id = Identifier::fromString($this->seeder->uuid)
        );
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(EventSourcedDomainEntity::class);
        $this->shouldHaveType(EventSourcedEntity::class);
        $this->shouldHaveType(Entity::class);
    }

    public function it_has_identity()
    {
        $this->id()->shouldReturn($this->id);
    }

    public function it_can_be_mark_as_deleted()
    {
        // Arrange
        $this->isDeleted()->shouldReturn(false);

        // Act
        $this->delete()->shouldBeNull();

        // Assert
        foreach ($this->storedEvents() as $storedEvent) {
            $storedEvent->shouldContain(DomainEntityWasDeletedEvent::class);
        }
        $this->isDeleted()->shouldReturn(true);
    }

    public function it_requires_a_domain_event_replay_method()
    {
        $event = new class implements Event
        {
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
                return '';
            }

            public function toArray(): array
            {
                return [];
            }

            public static function fromArray(array $array): Event
            {
                return new self;
            }
        };

        $this->shouldThrow(MissingEventReplayMethodException::class)->during(
            'restoreFromEvent',
            [$event]
        );
    }

    public function it_can_delete_all_stored_events()
    {
        $this->clearStoredEvents()->shouldBeNull();
        $this->storedEvents()->shouldReturn([]);
    }

}
