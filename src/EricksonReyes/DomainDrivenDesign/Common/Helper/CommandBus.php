<?php

namespace EricksonReyes\DomainDrivenDesign\Common\Helper;

use EricksonReyes\DomainDrivenDesign\Common\Helper\Exception\MissingHandleThisMethodException;
use EricksonReyes\DomainDrivenDesign\Common\Helper\Exception\NoAssignedCommandHandlerException;

/**
 * Class CommandBus
 * @package EricksonReyes\DomainDrivenDesign\Common\Helper
 */
class CommandBus
{
    /**
     * @var array
     */
    private $handlers = [];

    /**
     * @param string $commandClassName
     * @param $handlerClass
     */
    public function addHandler(string $commandClassName, $handlerClass): void
    {
        if (method_exists($handlerClass, 'handleThis') === false) {
            throw new MissingHandleThisMethodException('');
        }
        $this->registerHandler($commandClassName, $handlerClass);
    }

    /**
     * @param $commandClass
     */
    public function handleThis($commandClass): void
    {
        $commandWasNeverHandled = true;

        foreach ($this->handlers() as $commandClassName => $handlers) {
            foreach ($handlers as $handler) {
                if ($commandClass instanceof $commandClassName) {
                    $handler->handleThis($commandClass);
                    $commandWasNeverHandled = false;
                }
            }
        }

        if ($commandWasNeverHandled) {
            throw new NoAssignedCommandHandlerException('There is no handler for ' . get_class($commandClass));
        }
    }

    /**
     * @return array
     */
    private function handlers(): array
    {
        return $this->handlers;
    }

    /**
     * @param string $commandClassName
     * @param $handlerClass
     */
    private function registerHandler(string $commandClassName, $handlerClass): void
    {
        $this->handlers[$commandClassName][] = $handlerClass;
    }
}
