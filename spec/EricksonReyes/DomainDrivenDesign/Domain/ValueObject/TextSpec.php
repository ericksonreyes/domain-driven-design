<?php

namespace spec\EricksonReyes\DomainDrivenDesign\Domain\ValueObject;

use Faker\Factory;
use Faker\Generator;
use EricksonReyes\DomainDrivenDesign\Domain\ValueObject\Text;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TextSpec extends ObjectBehavior
{
    /**
     * @var string
     */
    private $value;

    /**
     * @var Generator
     */
    protected $seeder;

    public function __construct()
    {
        $this->seeder = Factory::create();
    }

    public function let()
    {
        $this->beConstructedWith($this->value = $this->seeder->paragraph);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(Text::class);
    }

    public function it_can_be_created_from_static_factory_method()
    {
        $this::fromString($this->seeder->paragraph)->shouldHaveType(Text::class);
    }

    public function it_knows_when_its_empty()
    {
        $this->beConstructedWith(str_repeat(' ', mt_rand(1, 10)));
        $this->isEmpty()->shouldReturn(true);
        $this->isNotEmpty()->shouldReturn(false);
    }

    public function it_knows_when_it_is_not_empty()
    {
        $this->beConstructedWith($this->value);
        $this->isEmpty()->shouldReturn(false);
        $this->isNotEmpty()->shouldReturn(true);
    }
}
