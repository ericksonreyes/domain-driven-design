<?php

namespace spec\EricksonReyes\DomainDrivenDesign\Domain\ValueObject;

use EricksonReyes\DomainDrivenDesign\Domain\ValueObject\Measurement;
use EricksonReyes\DomainDrivenDesign\Domain\ValueObject\UnitOfMeasurement;
use Faker\Factory;
use Faker\Generator;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MeasurementSpec extends ObjectBehavior
{
    /**
     * @var Generator
     */
    private $seeder;

    /**
     * @var Measurement
     */
    private $unitOfMeasurement;

    /**
     * @var int
     */
    private $value;

    public function __construct()
    {
        $this->seeder = Factory::create();
    }

    public function let(UnitOfMeasurement $unitOfMeasurement)
    {
        $this->beConstructedWith(
            $this->value = $this->seeder->numberBetween(0.1,10.99),
            $this->unitOfMeasurement = $unitOfMeasurement
        );
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(Measurement::class);
    }

    public function it_has_unitOfMeasurement()
    {
        $this->unitOfMeasurement()->shouldReturn($this->unitOfMeasurement);
    }

    public function it_has_value()
    {
        $this->value()->shouldReturn($this->value);
    }

    public function it_can_be_incremented()
    {
        $incrementBy = $this->seeder->numberBetween(0.1,10.99);
        $newValue = intval($this->value + $incrementBy);

        $this->incrementBy($incrementBy)->shouldHaveType(Measurement::class);
        $this->incrementBy($incrementBy)->value()->shouldReturn($newValue);
    }

    public function it_can_be_decremented()
    {
        $decrementBy = $this->seeder->numberBetween(0.1,10.99);
        $newValue = intval($this->value - $decrementBy);

        $this->decrementBy($decrementBy)->shouldHaveType(Measurement::class);
        $this->decrementBy($decrementBy)->value()->shouldReturn($newValue);
    }

    public function it_can_be_multiplied()
    {
        $multiplyBy = $this->seeder->numberBetween(0.1,10.99);
        $newValue = intval($this->value * $multiplyBy);

        $this->multiplyBy($multiplyBy)->shouldHaveType(Measurement::class);
        $this->multiplyBy($multiplyBy)->value()->shouldReturn($newValue);
    }

    public function it_can_be_divided()
    {
        $divideBy = $this->seeder->numberBetween(1,10.99);
        $newValue = intval($this->value / $divideBy);

        $this->divideBy($divideBy)->shouldHaveType(Measurement::class);
        $this->divideBy($divideBy)->value()->shouldReturn($newValue);
    }

    public function it_can_be_multiplied_and_converted(UnitOfMeasurement $newUnitOfMeasurement)
    {
        $multiplyBy =  $this->seeder->numberBetween(10.1,10.99);
        $newValue = intval($this->value * $multiplyBy);

        $this->multiplyAndConvertTo($multiplyBy, $newUnitOfMeasurement)->shouldHaveType(Measurement::class);
        $this->multiplyAndConvertTo($multiplyBy, $newUnitOfMeasurement)->value()->shouldReturn($newValue);
        $this->multiplyAndConvertTo($multiplyBy, $newUnitOfMeasurement)->unitOfMeasurement()->shouldReturn($newUnitOfMeasurement);
    }

    public function it_can_be_divided_and_converted(UnitOfMeasurement $newUnitOfMeasurement)
    {
        $divideBy =  $this->seeder->numberBetween(10.1,10.99);
        $newValue = intval($this->value / $divideBy);

        $this->divideAndConvertTo($divideBy, $newUnitOfMeasurement)->shouldHaveType(Measurement::class);
        $this->divideAndConvertTo($divideBy, $newUnitOfMeasurement)->value()->shouldReturn($newValue);
        $this->divideAndConvertTo($divideBy, $newUnitOfMeasurement)->unitOfMeasurement()->shouldReturn($newUnitOfMeasurement);
    }
}
