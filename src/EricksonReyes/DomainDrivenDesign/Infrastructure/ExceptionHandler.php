<?php

namespace EricksonReyes\DomainDrivenDesign\Infrastructure;

use Exception;

/**
 * Interface EventBusExceptionHandler
 * @package EricksonReyes\DomainDrivenDesign\Infrastructure
 */
interface ExceptionHandler
{
    /**
     * @param Exception $exception
     */
    public function handleThis(Exception $exception): void;
}
