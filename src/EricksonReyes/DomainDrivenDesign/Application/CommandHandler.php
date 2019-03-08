<?php

namespace EricksonReyes\DomainDrivenDesign\Application;

use EricksonReyes\DomainDrivenDesign\Application\Exception\DuplicateCommandHandlerException;
use EricksonReyes\DomainDrivenDesign\Application\Exception\MissingHandlerMethodException;

class CommandHandler
{

    /**
     * @var array
     */
    private $commands = [];

    /**
     * @param $commandHandlerInstance
     * @param string $commandClassName
     */
    public function addHandler($commandHandlerInstance, string $commandClassName): void
    {
        $this->registerCommand($commandClassName);
        $handlerInstanceClassName = get_class($commandHandlerInstance);

        if ($this->handlerHasAHandlerMethod($commandHandlerInstance)) {
            throw new MissingHandlerMethodException(
                "{$handlerInstanceClassName} must have a handleThis method."
            );
        }

        if ($this->alreadyHandlesThisCommand($commandHandlerInstance, $commandClassName)) {
            throw new DuplicateCommandHandlerException(
                "{$handlerInstanceClassName} is already handling {$commandClassName}."
            );
        }

        $this->assignHandlerInstanceToCommandName($commandHandlerInstance, $commandClassName);
    }

    /**
     * @param $commandClassInstance
     * @return array
     */
    public function execute($commandClassInstance): array
    {
        $executionResult = [];
        $commandClassName = get_class($commandClassInstance);
        foreach ($this->commands() as $storedCommandClassName => $commandHandlers) {

            if ($storedCommandClassName === $commandClassName) {
                foreach ($commandHandlers as $commandHandler) {
                    $commandHandlerClassName = get_class($commandHandler);
                    $executionResult[$commandHandlerClassName] = $commandHandler->handleThis($commandClassInstance);
                }
            }
        }
        return $executionResult;
    }

    /**
     * @return array
     */
    private function commands(): array
    {
        return $this->commands;
    }

    /**
     * @param $commandHandlerInstance
     * @param string $commandClassName
     * @return bool
     */
    private function alreadyHandlesThisCommand($commandHandlerInstance, string $commandClassName): bool
    {
        return in_array($commandHandlerInstance, $this->commands[$commandClassName], true);
    }

    /**
     * @param $commandHandlerInstance
     * @return bool
     */
    private function handlerHasAHandlerMethod($commandHandlerInstance): bool
    {
        return method_exists($commandHandlerInstance, 'handleThis') === false;
    }

    /**
     * @param string $commandClassName
     */
    private function registerCommand(string $commandClassName): void
    {
        if (array_key_exists($commandClassName, $this->commands) === false) {
            $this->commands[$commandClassName] = [];
        }
    }

    /**
     * @param $commandHandlerInstance
     * @param string $commandClassName
     */
    private function assignHandlerInstanceToCommandName($commandHandlerInstance, string $commandClassName): void
    {
        $this->commands[$commandClassName][] = $commandHandlerInstance;
    }
}