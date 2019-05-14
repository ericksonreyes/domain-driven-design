<?php
/**
 * Created by PhpStorm.
 * User: ericksonreyes
 * Date: 2019-05-14
 * Time: 17:11
 */

namespace EricksonReyes\DomainDrivenDesign\Infrastructure;

use EricksonReyes\DomainDrivenDesign\Domain\Event;

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
}
