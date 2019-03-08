<?php

namespace spec\EricksonReyes\DomainDrivenDesign\Domain\ValueObject;

use EricksonReyes\DomainDrivenDesign\Domain\ValueObject\Number;
use Faker\Factory;
use Faker\Generator;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class NumberSpec extends ObjectBehavior
{

    /**
     * @var Generator
     */
    private $seeder;

    /**
     * @var int
     */
    private $amount;

    public function __construct()
    {
        $this->seeder = Factory::create();
    }

    public function let()
    {
        $this->beConstructedWith(
            $this->amount = $this->seeder->numberBetween(0.1, 10.99)
        );
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(Number::class);
    }

    public function it_has_amount()
    {
        $this->amount()->shouldReturn($this->amount);
    }

    public function it_can_be_incremented()
    {
        $incrementBy = $this->seeder->numberBetween(0.1, 10.99);
        $newValue = intval($this->amount + $incrementBy);

        $this->incrementBy($incrementBy)->shouldHaveType(Number::class);
        $this->incrementBy($incrementBy)->amount()->shouldReturn($newValue);
    }

    public function it_can_be_decremented()
    {
        $decrementBy = $this->seeder->numberBetween(0.1, 10.99);
        $newValue = intval($this->amount - $decrementBy);

        $this->decrementBy($decrementBy)->shouldHaveType(Number::class);
        $this->decrementBy($decrementBy)->amount()->shouldReturn($newValue);
    }

    public function it_can_be_multiplied()
    {
        $multiplyBy = $this->seeder->numberBetween(0.1, 10.99);
        $newValue = intval($this->amount * $multiplyBy);

        $this->multiplyBy($multiplyBy)->shouldHaveType(Number::class);
        $this->multiplyBy($multiplyBy)->amount()->shouldReturn($newValue);
    }

    public function it_can_be_divided()
    {
        $divideBy = $this->seeder->numberBetween(1, 10.99);
        $newValue = intval($this->amount / $divideBy);

        $this->divideBy($divideBy)->shouldHaveType(Number::class);
        $this->divideBy($divideBy)->amount()->shouldReturn($newValue);
    }

}
