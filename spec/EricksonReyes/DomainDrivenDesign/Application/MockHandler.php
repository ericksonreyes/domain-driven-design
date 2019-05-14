<?php

namespace spec\EricksonReyes\DomainDrivenDesign\Application;


class MockHandler
{
    public function handleThis(MockCommand $command)
    {
        return $command::name();
    }
}