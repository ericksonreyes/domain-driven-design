<?php

namespace spec\EricksonReyes\DomainDrivenDesign\Example\Domain;

use DateTimeImmutable;
use EricksonReyes\DomainDrivenDesign\Common\Exception\DomainEventOwnershipError;
use EricksonReyes\DomainDrivenDesign\Common\Exception\MissingEventReplayMethodError;
use EricksonReyes\DomainDrivenDesign\Common\ValueObject\Identifier;
use EricksonReyes\DomainDrivenDesign\Domain\Entity;
use EricksonReyes\DomainDrivenDesign\EventSourcedEntity;
use EricksonReyes\DomainDrivenDesign\Example\Domain\DomainEntityWasDeletedEvent;
use EricksonReyes\DomainDrivenDesign\Example\Domain\EventSourcedDomainEntity;
use spec\EricksonReyes\DomainDrivenDesign\Domain\EventSourcedDomainEntityUnitTest;

class EventSourcedDomainEntitySpec extends EventSourcedDomainEntityUnitTest
{

    public function let(Identifier $identifier)
    {
        $this->beConstructedWith(
            $this->id = $identifier
        );
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(EventSourcedDomainEntity::class);
        $this->shouldHaveType(EventSourcedEntity::class);
        $this->shouldHaveType(Entity::class);
    }

    public function it_cant_be_deleted_twice()
    {
        // Arrange
        $uuid = $this->seeder->uuid;
        $this->id->__toString()->shouldBeCalled()->willReturn($uuid);
        $this->id->doesNotMatch($uuid)->shouldBeCalled()->willReturn(false);

        // Act
        $this->delete()->shouldBeNull();
        $this->delete()->shouldBeNull();

        // Assert
        foreach ($this->storedEvents() as $storedEvent) {
            $storedEvent->shouldContain(DomainEntityWasDeletedEvent::class);
        }

    }
    public function it_can_be_deleted()
    {
        // Arrange
        $uuid = $this->seeder->uuid;
        $this->id->__toString()->shouldBeCalled()->willReturn($uuid);
        $this->id->doesNotMatch($uuid)->shouldBeCalled()->willReturn(false);

        // Act
        $this->delete()->shouldBeNull();

        // Assert
        foreach ($this->storedEvents() as $storedEvent) {
            $storedEvent->shouldContain(DomainEntityWasDeletedEvent::class);
        }

    }

    public function it_can_be_restored_from_event(DomainEntityWasDeletedEvent $event)
    {
        // Arrange
        $uuid = $this->seeder->uuid;
        $event->entityId()->shouldBeCalled()->willReturn($uuid);
        $event->eventName()->shouldBeCalled()->willReturn('DomainEntityWasDeleted');
        $event->happenedOn()->shouldBeCalled()->willReturn(new DateTimeImmutable());

        $this->id->doesNotMatch($uuid)->shouldBeCalled()->willReturn(false);
        $this->restoreFromEvent($event);
    }

    public function it_requires_domain_events_to_have_replay_methods()
    {
        $event = new MockDomainEvent($this->seeder->uuid);
        $this->shouldThrow(MissingEventReplayMethodError::class)->during(
            'restoreFromEvent',
            [$event]
        );
    }

    public function it_prevents_restoration_from_events_that_doesnt_belong_to_it(DomainEntityWasDeletedEvent $event)
    {
        $uuid = $this->seeder->uuid;
        $event->entityId()->shouldBeCalled()->willReturn($uuid);
        $event->eventName()->shouldBeCalled()->willReturn('DomainEntityWasDeleted');
        $this->id->doesNotMatch($uuid)->shouldBeCalled()->willReturn(true);
        $this->shouldThrow(DomainEventOwnershipError::class)->during(
            'restoreFromEvent',
            [$event]
        );
    }


    public function it_can_be_matched(Entity $anotherEntity, Identifier $anotherIdentifier)
    {
        $uuid = $this->seeder->uuid;
        $anotherIdentifier->__toString()->shouldBeCalled()->willReturn($uuid);
        $anotherEntity->id()->shouldBeCalled()->willReturn($anotherIdentifier);

        $this->id->matches($uuid)->shouldBeCalled()->willReturn(true);
        $this->matches($anotherEntity)->shouldReturn(true);
        $this->doesNotMatch($anotherEntity)->shouldReturn(false);
    }

    public function it_can_be_mismatched(Entity $anotherEntity, Identifier $anotherIdentifier)
    {
        $uuid = $this->seeder->uuid;
        $anotherIdentifier->__toString()->shouldBeCalled()->willReturn($uuid);
        $anotherEntity->id()->shouldBeCalled()->willReturn($anotherIdentifier);

        $this->id->matches($uuid)->shouldBeCalled()->willReturn(false);
        $this->matches($anotherEntity)->shouldReturn(false);
        $this->doesNotMatch($anotherEntity)->shouldReturn(true);
    }
}
