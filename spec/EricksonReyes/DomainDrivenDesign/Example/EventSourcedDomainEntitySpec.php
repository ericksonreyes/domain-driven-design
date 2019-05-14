<?php

namespace spec\EricksonReyes\DomainDrivenDesign\Example;

use DateTimeImmutable;
use EricksonReyes\DomainDrivenDesign\Common\Exception\DomainEventOwnershipException;
use EricksonReyes\DomainDrivenDesign\Common\Exception\MissingEventReplayMethodException;
use EricksonReyes\DomainDrivenDesign\Domain\Entity;
use EricksonReyes\DomainDrivenDesign\EventSourcedEntity;
use EricksonReyes\DomainDrivenDesign\Example\DomainEntityWasDeletedEvent;
use EricksonReyes\DomainDrivenDesign\Example\EventSourcedDomainEntity;
use spec\EricksonReyes\DomainDrivenDesign\Domain\EventSourcedDomainEntityUnitTest;

class EventSourcedDomainEntitySpec extends EventSourcedDomainEntityUnitTest
{

    public function let()
    {
        $this->beConstructedWith(
            $this->id = $this->seeder->uuid
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
        $event->entityId()->shouldBeCalled()->wilLReturn($this->id);
        $event->eventName()->shouldBeCalled()->willReturn('DomainEntityWasDeleted');
        $event->happenedOn()->shouldBeCalled()->willReturn(new DateTimeImmutable());
        $this->restoreFromEvent($event);
        $this->isDeleted()->shouldReturn(true);
    }

    public function it_requires_domain_events_to_have_replay_methods()
    {
        $event = new MockDomainEvent($this->id);
        $this->shouldThrow(MissingEventReplayMethodException::class)->during(
            'restoreFromEvent',
            [$event]
        );
    }

    public function it_prevents_restoration_from_events_that_doesnt_belong_to_it(DomainEntityWasDeletedEvent $event)
    {
        $event->entityId()->shouldBeCalled()->wilLReturn($this->seeder->uuid);
        $event->eventName()->shouldBeCalled()->willReturn('DomainEntityWasDeleted');
        $this->shouldThrow(DomainEventOwnershipException::class)->during(
            'restoreFromEvent',
            [$event]
        );
    }

}
