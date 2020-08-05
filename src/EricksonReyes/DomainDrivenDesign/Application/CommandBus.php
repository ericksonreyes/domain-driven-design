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
    private $commands = [];

    /**
     * @param $handler
     * @param string $command
     */
    public function addHandler($handler, string $command): void
    {
        $handlerInstanceClassName = get_class($handler);

        if ($this->handlerHasAHandlerMethod($handler)) {
            throw new MissingHandlerMethodError(
                "{$handlerInstanceClassName} must have a handleThis method."
            );
        }

        if ($this->commandIsBeingHandledAlready($command)) {
            throw new DuplicateCommandHandlerError(
                "{$command} is already being handled by " .
                $this->getCommandHandlerName($command) . "."
            );
        }

        $this->assignHandlerInstanceToCommandName($handler, $command);
    }

    /**
     * @param $command
     * @throws UnhandledCommandError
     */
    public function execute($command): void
    {
        $commandClassName = get_class($command);

        foreach ($this->commands() as $storedCommandClassName => $commandHandler) {
            if ($this->commandMatchesAHandler($storedCommandClassName, $command)) {
                $commandHandler->handleThis($command);
                return;
            }
        }
        throw new UnhandledCommandError("There is no command handler for {$commandClassName}");
    }

    /**
     * @return array
     */
    private function commands(): array
    {
        return $this->commands;
    }

    /**
     * @param string $command
     * @return bool
     */
    private function commandIsBeingHandledAlready(string $command): bool
    {
        return array_key_exists($command, $this->commands());
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
     * @param string $command
     */
    private function assignHandlerInstanceToCommandName($commandHandler, string $command): void
    {
        $this->commands[$command] = $commandHandler;
    }

    /**
     * @param $command
     * @return string
     */
    private function getCommandHandlerName($command)
    {
        return get_class($this->commands()[$command]);
    }

    /**
     * @param $storedCommandClassName
     * @param $command
     * @return bool
     */
    private function commandMatchesAHandler($storedCommandClassName, $command): bool
    {
        $commandClassName = get_class($command);

        return $storedCommandClassName === $commandClassName ||
            $command instanceof $storedCommandClassName;
    }
}
