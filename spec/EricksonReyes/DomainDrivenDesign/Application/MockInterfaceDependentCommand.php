<?php


namespace spec\EricksonReyes\DomainDrivenDesign\Application;


class MockInterfaceDependentCommand implements InterfaceDependentCommand
{
    /**
     * @return string
     */
    public static function name(): string
    {
        return __CLASS__;
    }


}