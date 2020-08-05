<?php

namespace EricksonReyes\DomainDrivenDesign\Infrastructure;

use EricksonReyes\DomainDrivenDesign\Application\Exception\UnhandledCommandError;

/**
 * Class CommandHandler
 * @package EricksonReyes\DomainDrivenDesign\Application
 */
interface CommandBus
{
    /**
     * @param $handler
     * @param string $commandName
     */
    public function addHandler($handler, string $commandName): void;

    /**
     * @param $command
     * @throws UnhandledCommandError
     */
    public function execute($command): void;
}
