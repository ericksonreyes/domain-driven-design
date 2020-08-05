<?php

namespace EricksonReyes\DomainDrivenDesign\Application;

use EricksonReyes\DomainDrivenDesign\Application\Exception\DuplicateCommandHandlerError;
use EricksonReyes\DomainDrivenDesign\Application\Exception\MissingHandlerMethodError;
use EricksonReyes\DomainDrivenDesign\Application\Exception\UnhandledCommandError;
use EricksonReyes\DomainDrivenDesign\Infrastructure\CommandBus as CommandBusInterface;

/**
 * Class CommandHandler
 * @package EricksonReyes\DomainDrivenDesign\Application
 */
class CommandBus implements CommandBusInterface
{

    /**
     * @var array
     */
    private $handlers = [];

    /**
     * @param $handler
     * @param string $commandName
     */
    public function addHandler($handler, string $commandName): void
    {
        $handlerInstanceClassName = get_class($handler);

        if ($this->handlerHasAHandlerMethod($handler)) {
            throw new MissingHandlerMethodError(
                "{$handlerInstanceClassName} must have a handleThis method."
            );
        }

        if ($this->commandIsBeingHandledAlready($commandName)) {
            throw new DuplicateCommandHandlerError(
                "{$commandName} is already being handled by " .
                $this->getHandlerName($commandName) . "."
            );
        }

        $this->assignHandlerInstanceToCommandName($handler, $commandName);
    }

    /**
     * @param $command
     * @throws UnhandledCommandError
     */
    public function execute($command): void
    {
        $commandClassName = get_class($command);

        foreach ($this->handlers() as $commandName => $handler) {
            if ($this->commandMatchesAHandler($commandName, $command)) {
                $handler->handleThis($command);
                return;
            }
        }
        throw new UnhandledCommandError("There is no command handler for {$commandClassName}");
    }

    /**
     * @return array
     */
    private function handlers(): array
    {
        return $this->handlers;
    }

    /**
     * @param string $command
     * @return bool
     */
    private function commandIsBeingHandledAlready(string $command): bool
    {
        return array_key_exists($command, $this->handlers());
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
     * @param $commandHandler
     * @param string $commandName
     */
    private function assignHandlerInstanceToCommandName($commandHandler, string $commandName): void
    {
        $this->handlers[$commandName] = $commandHandler;
    }

    /**
     * @param string $commandName
     * @return string
     */
    private function getHandlerName(string $commandName)
    {
        return get_class($this->handlers()[$commandName]);
    }

    /**
     * @param string $commandName
     * @param $command
     * @return bool
     */
    private function commandMatchesAHandler(string $commandName, $command): bool
    {
        $commandClassName = get_class($command);

        return $commandName === $commandClassName ||
            $command instanceof $commandName;
    }
}
