<?php

namespace spec\EricksonReyes\DomainDrivenDesign\Common\Helper;

use EricksonReyes\DomainDrivenDesign\Common\Helper\CommandBus;
use EricksonReyes\DomainDrivenDesign\Common\Helper\Exception\MissingHandleThisMethodException;
use EricksonReyes\DomainDrivenDesign\Common\Helper\Exception\NoAssignedCommandHandlerException;
use PhpSpec\ObjectBehavior;

class CommandBusSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(CommandBus::class);
    }

    public function it_gathers_command_handlers()
    {
        $command = MockCommand::class;
        $handler = new MockHandler();

        $this->addHandler($command, $handler)->shouldBeNull();
    }

    public function it_only_accepts_handler_classes_with_handleThis_method()
    {
        $command = MockCommand::class;
        $handler = new MockInvalidHandler();

        $this->shouldThrow(MissingHandleThisMethodException::class)->during(
            'addHandler',
            [
                $command,
                $handler
            ]
        );
    }

    public function it_handles_commands(
        MockCommand $command,
        MockHandler $handler,
        MockAnotherHandler $anotherHandler
    )
    {
        // Arrange
        $this->addHandler(MockCommand::class, $handler);
        $this->addHandler(MockCommand::class, $anotherHandler);

        // Assert
        $handler->handleThis($command)->shouldBeCalled();
        $anotherHandler->handleThis($command)->shouldBeCalled();

        // Act
        $this->handleThis($command)->shouldBeNull();
    }

    public function it_throws_exception_when_there_is_no_handler_for_the_command()
    {
        $this->shouldThrow(NoAssignedCommandHandlerException::class)->during(
            'handleThis',
            [new MockCommand()]
        );
    }
}
