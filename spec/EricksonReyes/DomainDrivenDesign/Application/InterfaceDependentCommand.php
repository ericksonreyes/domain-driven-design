<?php


namespace spec\EricksonReyes\DomainDrivenDesign\Application;

/**
 * Interface InterfacedCommand
 * @package spec\EricksonReyes\DomainDrivenDesign\Application
 */
interface InterfaceDependentCommand
{
    /**
     * @return string
     */
    public static function name(): string;
}