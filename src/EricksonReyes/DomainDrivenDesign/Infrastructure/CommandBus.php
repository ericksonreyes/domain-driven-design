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
     * @param $handler
     * @param string $command
     */
    public function addHandler($handler, string $command): void;

    /**
     * @param $command
     * @throws UnhandledCommandException
     */
    public function execute($command): void;
}
