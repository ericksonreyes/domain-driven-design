<?php


namespace spec\EricksonReyes\DomainDrivenDesign\Application;

/**
 * Class MockInterfaceDependentCommandHandler
 * @package spec\EricksonReyes\DomainDrivenDesign\Application
 */
class MockInterfaceDependentCommandHandler
{

    /**
     * @param InterfaceDependentCommand $command
     * @return string
     */
    public function handleThis(InterfaceDependentCommand $command)
    {
        return $command::name();
    }
}