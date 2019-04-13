<?php

namespace spec\EricksonReyes\DomainDrivenDesign\Domain;

use EricksonReyes\DomainDrivenDesign\Common\Collection;
use EricksonReyes\DomainDrivenDesign\Domain\Event;
use EricksonReyes\DomainDrivenDesign\Domain\History;
use PhpSpec\ObjectBehavior;

class HistorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(History::class);
        $this->shouldBeAnInstanceOf(Collection::class);
    }

    public function it_records_domain_events(Event $event)
    {
        $this->recordThis($event)->shouldBeNull();
    }

    public function it_can_count_events(Event $event)
    {
        $expectedNumberOfEvents = mt_rand(1, 10);
        $this->count()->shouldReturn(0);

        for ($eventCount = 0; $eventCount < $expectedNumberOfEvents; $eventCount++) {
            $this->recordThis($event);
        }
        $this->count()->shouldReturn($expectedNumberOfEvents);
    }

    public function it_can_be_traversed(Event $event)
    {
        $events = [];
        $expectedNumberOfEvents = mt_rand(1, 1);
        for ($eventCount = 0; $eventCount < $expectedNumberOfEvents; $eventCount++) {
            $events[] = $event->getWrappedObject();
            $this->recordThis($event);
        }

        foreach ($this->getWrappedObject() as $index => $storedEvent) {
            \assert($storedEvent === $events[$index]);
        }
    }
}
