<?php

namespace spec\EricksonReyes\DomainDrivenDesign\Application;

use EricksonReyes\DomainDrivenDesign\Application\CommandBus;
use EricksonReyes\DomainDrivenDesign\Application\Exception\DuplicateCommandHandlerError;
use EricksonReyes\DomainDrivenDesign\Application\Exception\MissingHandlerMethodError;
use EricksonReyes\DomainDrivenDesign\Application\Exception\UnhandledCommandError;
use EricksonReyes\DomainDrivenDesign\Infrastructure\CommandBus as CommandBusInterface;
use PhpSpec\ObjectBehavior;

class CommandBusSpec extends ObjectBehavior
{
    /**
     * @var MockHandler
     */
    private $handler;

    /**
     * @var MockCommand
     */
    private $command;

    public function let()
    {
        $this->command = new MockCommand();
        $this->handler = new MockHandler();
    }

    /**
     *
     */
    public function it_is_initializable()
    {
        $this->shouldHaveType(CommandBus::class);
        $this->shouldHaveType(CommandBusInterface::class);
    }

    public function it_accepts_handlers()
    {
        $this->addHandler(new MockHandler(), MockCommand::class)->shouldBeNull();
    }

    public function it_executes_commands()
    {
        $this->addHandler(new MockHandler(), MockCommand::class);
        $this->execute(new MockCommand())->shouldBeNull();
    }

    public function it_can_handle_interface_dependent_commands()
    {
        $this->addHandler(new MockInterfaceDependentCommandHandler(), InterfaceDependentCommand::class);
        $this->execute(new MockInterfaceDependentCommand())->shouldBeNull();
    }

    public function it_requires_a_handler_for_commands()
    {
        $this->shouldThrow(UnhandledCommandError::class)->during('execute', [
            new MockCommand()
        ]);
    }

    public function it_requires_handler_to_have_handler_methods()
    {
        $this->shouldThrow(MissingHandlerMethodError::class)->during('addHandler', [
            new MockEmptyHandler(),
            MockCommand::class
        ]);
    }

    public function it_prevents_duplicate_handler_for_a_command()
    {
        $handler = new MockHandler();
        $this->addHandler($handler, MockCommand::class);
        $this->shouldThrow(DuplicateCommandHandlerError::class)->during('addHandler', [
            $handler,
            MockCommand::class
        ]);
    }
}