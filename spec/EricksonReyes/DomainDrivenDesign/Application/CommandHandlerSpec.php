<?php

namespace spec\EricksonReyes\DomainDrivenDesign\Application;

use EricksonReyes\DomainDrivenDesign\Application\CommandHandler;
use EricksonReyes\DomainDrivenDesign\Application\Exception\DuplicateCommandHandlerException;
use EricksonReyes\DomainDrivenDesign\Application\Exception\MissingHandlerMethodException;
use EricksonReyes\DomainDrivenDesign\Application\Exception\UnhandledCommandException;
use PhpSpec\ObjectBehavior;

class CommandHandlerSpec extends ObjectBehavior
{
    /**
     * @var Handler
     */
    private $handler;

    /**
     * @var Command
     */
    private $command;

    public function let()
    {
        $this->command = new Command();
        $this->handler = new Handler();
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(CommandHandler::class);
    }

    public function it_accepts_handlers()
    {
        $this->addHandler(new Handler(), Command::class)->shouldBeNull();
    }

    public function it_executes_commands()
    {
        $this->addHandler(new Handler(), Command::class);
        $this->execute(new Command())->shouldReturn([Handler::class => Command::name()]);
    }

    public function it_requires_a_handler_for_commands()
    {
        $this->shouldThrow(UnhandledCommandException::class)->during('execute', [
            new Command()
        ]);
    }

    public function it_requires_handler_to_have_handler_methods()
    {
        $this->shouldThrow(MissingHandlerMethodException::class)->during('addHandler', [
            new EmptyHandler(),
            Command::class
        ]);
    }

    public function it_prevents_duplicate_handler_for_a_command()
    {
        $handler = new Handler();
        $this->addHandler($handler, Command::class);
        $this->shouldThrow(DuplicateCommandHandlerException::class)->during('addHandler', [
            $handler,
            Command::class
        ]);
    }
}

class Command
{
    public static function name()
    {
        return __CLASS__;
    }
}

class Handler
{
    public function handleThis(Command $command)
    {
        return $command::name();
    }
}

class EmptyHandler
{

}