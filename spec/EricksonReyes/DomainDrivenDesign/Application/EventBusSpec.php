<?php

namespace spec\EricksonReyes\DomainDrivenDesign\Application;

use EricksonReyes\DomainDrivenDesign\Application\EventBus;
use EricksonReyes\DomainDrivenDesign\Application\Exception\DuplicateEventHandlerException;
use EricksonReyes\DomainDrivenDesign\Domain\Event;
use EricksonReyes\DomainDrivenDesign\Infrastructure\EventBus as EventBusInterface;
use EricksonReyes\DomainDrivenDesign\Infrastructure\EventHandler;
use EricksonReyes\DomainDrivenDesign\Infrastructure\ExceptionHandler;
use Faker\Factory;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use RuntimeException;

class EventBusSpec extends ObjectBehavior
{
    /**
     * @var EventHandler[]
     */
    private $handlers;

    public function it_is_initializable()
    {
        $this->shouldHaveType(EventBus::class);
        $this->shouldHaveType(EventBusInterface::class);
    }

    public function it_registers_handlers(EventHandler $eventHandler)
    {
        $this->register($eventHandler)->shouldBeNull();
    }

    public function it_stores_handlers(EventHandler $eventHandler)
    {
        $this->register($eventHandler);
        $this->handlers()->shouldHaveCount(1);
    }

    public function it_prevents_duplicate_event_handlers(EventHandler $eventHandler)
    {
        $eventHandler->name()->shouldBeCalled()->willReturn(Factory::create()->word);
        $this->register($eventHandler);
        $this->shouldThrow(DuplicateEventHandlerException::class)->during('register', [
            $eventHandler
        ]);
    }

    public function it_dispatches_events(
        EventHandler $interestedEventHandler,
        EventHandler $eventHandler,
        Event $event
    )
    {
        $interestedEventHandler->isInterestedInThis($event)->shouldBeCalled()->willReturn(true);
        $interestedEventHandler->beNotifiedAbout($event)->shouldBeCalled();

        $eventHandler->isInterestedInThis($event)->shouldBeCalled()->willReturn(false);
        $eventHandler->name()->shouldBeCalled()->willReturn(Factory::create()->word);

        $this->register($interestedEventHandler);
        $this->register($eventHandler);
        $this->dispatch($event)->shouldBeNull();
    }

    public function it_can_have_exception_handlers(
        ExceptionHandler $exceptionHandler,
        EventHandler $eventHandler,
        MockBuggedEventHandler $buggedEventHandler,
        EventHandler $anotherEventHandler,
        Event $event
    )
    {
        $this->registerExceptionHandler($exceptionHandler)->shouldBeNull();

        $this->register($eventHandler);
        $this->register($buggedEventHandler);
        $this->register($anotherEventHandler);

        $eventHandler->beNotifiedAbout($event)->shouldBeCalled();
        $buggedEventHandler->beNotifiedAbout($event)->shouldBeCalled()->willThrow(RuntimeException::class);
        $anotherEventHandler->beNotifiedAbout($event)->shouldBeCalled();

        $eventHandler->isInterestedInThis($event)->shouldBeCalled()->willReturn(true);
        $buggedEventHandler->isInterestedInThis($event)->shouldBeCalled()->willReturn(true);
        $anotherEventHandler->isInterestedInThis($event)->shouldBeCalled()->willReturn(true);

        $exceptionHandler->handleThis(Argument::type(RuntimeException::class))->shouldBeCalled();

        $this->dispatch($event);
    }
}
