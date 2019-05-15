<?php

namespace EricksonReyes\DomainDrivenDesign\Infrastructure;

use EricksonReyes\DomainDrivenDesign\Domain\Event;

/**
 * Interface EventBus
 * @package EricksonReyes\DomainDrivenDesign\Infrastructure
 */
interface EventBus
{
    /**
     * @param EventHandler $handler
     */
    public function register(EventHandler $handler): void;

    /**
     * @param Event $event
     */
    public function dispatch(Event $event): void;

    /**
     * @return EventHandler[]
     */
    public function handlers(): array;

    /**
     * @param ExceptionHandler $exceptionHandler
     */
    public function registerExceptionHandler(ExceptionHandler $exceptionHandler): void;

    /**
     * @return ExceptionHandler[]
     */
    public function exceptionHandlers(): array;
}
