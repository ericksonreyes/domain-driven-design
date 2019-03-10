<?php

namespace spec\EricksonReyes\DomainDrivenDesign\Domain;


abstract class EventSourcedDomainEntityUnitTest extends DomainEntityUnitTest
{

    public function it_has_stored_events()
    {
        $this->storedEvents()->shouldBeArray();
    }

    public function it_can_delete_all_stored_events()
    {
        $this->clearStoredEvents()->shouldBeNull();
        $this->storedEvents()->shouldReturn([]);
    }

    abstract public function it_requires_domain_events_to_have_replay_methods();
}