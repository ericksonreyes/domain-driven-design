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
use spec\EricksonReyes\DomainDrivenDesign\Domain\EventSourcedDomainEntityUnitTest;

class EventSourcedDomainEntitySpec extends EventSourcedDomainEntityUnitTest
{

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

    public function it_can_only_be_deleted_once()
    {
        // Arrange
        $this->isDeleted()->shouldReturn(false);

        // Act
        $this->delete()->shouldBeNull();
        $this->delete()->shouldBeNull();

        // Assert
        foreach ($this->storedEvents() as $storedEvent) {
            $storedEvent->shouldContain(DomainEntityWasDeletedEvent::class);
        }
        $this->isDeleted()->shouldReturn(true);

    }

    public function it_can_be_restored_from_event(DomainEntityWasDeletedEvent $event)
    {
        $event->eventName()->shouldBeCalled()->willReturn('DomainEntityWasDeleted');
        $event->happenedOn()->shouldBeCalled()->willReturn(new DateTimeImmutable());
        $this->restoreFromEvent($event);
        $this->isDeleted()->shouldReturn(true);
    }

    public function it_requires_domain_events_to_have_replay_methods()
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

}
