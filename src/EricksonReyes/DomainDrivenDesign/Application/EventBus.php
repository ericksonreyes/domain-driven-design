<?php

namespace EricksonReyes\DomainDrivenDesign\Application;

use EricksonReyes\DomainDrivenDesign\Application\Exception\DuplicateEventHandlerError;
use EricksonReyes\DomainDrivenDesign\Domain\Event;
use EricksonReyes\DomainDrivenDesign\Infrastructure\EventBus as EventBusInterface;
use EricksonReyes\DomainDrivenDesign\Infrastructure\EventHandler;
use EricksonReyes\DomainDrivenDesign\Infrastructure\ExceptionHandler;
use Exception;

/**
 * Class EventBus
 * @package EricksonReyes\DomainDrivenDesign\Application
 */
class EventBus implements EventBusInterface
{
    /**
     * @var EventHandler[]
     */
    private $handlers = [];

    /**
     * @var ExceptionHandler[]
     */
    private $exceptionHandlers = [];

    /**
     * @param EventHandler $handler
     */
    public function register(EventHandler $handler): void
    {
        foreach ($this->handlers() as $registeredHandler) {
            if ($handler === $registeredHandler) {
                throw new DuplicateEventHandlerError(
                    $handler->name() . ' is already registered in the event bus.'
                );
            }
        }
        $this->handlers[] = $handler;
    }

    /**
     * @param ExceptionHandler $exceptionHandler
     */
    public function registerExceptionHandler(ExceptionHandler $exceptionHandler): void
    {
        $this->exceptionHandlers[] = $exceptionHandler;
    }

    /**
     * @param Event $event
     */
    public function dispatch(Event $event): void
    {
        foreach ($this->handlers() as $handler) {
            try {
                if ($handler->isInterestedInThis($event)) {
                    $handler->beNotifiedAbout($event);
                }
            } catch (Exception $exception) {
                foreach ($this->exceptionHandlers() as $exceptionHandler) {
                    $exceptionHandler->handleThis($exception);
                }
            }
        }
    }

    /**
     * @return EventHandler[]
     */
    public function handlers(): array
    {
        return $this->handlers;
    }

    /**
     * @return ExceptionHandler[]
     */
    public function exceptionHandlers(): array
    {
        return $this->exceptionHandlers;
    }
}
