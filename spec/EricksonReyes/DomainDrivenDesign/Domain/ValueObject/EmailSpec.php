<?php

namespace spec\EricksonReyes\DomainDrivenDesign\Domain\ValueObject;

use Faker\Factory;
use Faker\Generator;
use EricksonReyes\DomainDrivenDesign\Domain\ValueObject\Email;
use EricksonReyes\DomainDrivenDesign\Domain\ValueObject\Text;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class EmailSpec extends ObjectBehavior
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
        $this->beConstructedWith($this->value = $this->seeder->email);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(Email::class);
        $this->shouldHaveType(Text::class);
    }

    public function it_knows_when_its_invalid()
    {
        $this->beConstructedWith(str_repeat(' ', mt_rand(1, 10)));
        $this->isValid()->shouldReturn(false);
        $this->isInvalid()->shouldReturn(true);
    }

    public function it_knows_when_it_is_valid()
    {
        $this->beConstructedWith($this->value);
        $this->isValid()->shouldReturn(true);
        $this->isInvalid()->shouldReturn(false);
    }
}
