<?php

namespace spec\EricksonReyes\DomainDrivenDesign\Domain\ValueObject;

use EricksonReyes\DomainDrivenDesign\Domain\ValueObject\UnitOfMeasurement;
use Faker\Factory;
use Faker\Generator;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UnitOfMeasurementSpec extends ObjectBehavior
{
    /**
     * @var string
     */
    private $code;

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
        $this->beConstructedWith($this->code = $this->seeder->paragraph);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(UnitOfMeasurement::class);
        $this->value()->shouldReturn($this->code);
    }

    public function it_can_be_created_from_static_factory_method()
    {
        $this::fromString($this->code = $this->seeder->word)->shouldHaveType(UnitOfMeasurement::class);
        $this::fromString($this->code = $this->seeder->word)->value()->shouldReturn($this->code);
    }

    public function it_knows_when_its_empty()
    {
        $this->beConstructedWith(str_repeat(' ', mt_rand(1, 10)));
        $this->isEmpty()->shouldReturn(true);
        $this->isNotEmpty()->shouldReturn(false);
    }

    public function it_knows_when_it_is_not_empty()
    {
        $this->beConstructedWith($this->code);
        $this->isEmpty()->shouldReturn(false);
        $this->isNotEmpty()->shouldReturn(true);
    }

}
