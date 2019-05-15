<?php

namespace EricksonReyes\DomainDrivenDesign\Infrastructure;

use EricksonReyes\DomainDrivenDesign\Application\Exception\UnhandledCommandException;

/**
 * Class CommandHandler
 * @package EricksonReyes\DomainDrivenDesign\Application
 */
interface CommandBus
{
    /**
     * @param $commandHandlerInstance
     * @param string $commandClassName
     */
    public function addHandler($commandHandlerInstance, string $commandClassName): void;

    /**
     * @param $commandClassInstance
     * @return array
     * @throws UnhandledCommandException
     */
    public function execute($commandClassInstance): array;
}
