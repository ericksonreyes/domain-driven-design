<?php

namespace spec\EricksonReyes\DomainDrivenDesign\Domain\ValueObject;

use EricksonReyes\DomainDrivenDesign\Domain\ValueObject\Currency;
use EricksonReyes\DomainDrivenDesign\Domain\ValueObject\Money;
use Faker\Factory;
use Faker\Generator;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MoneySpec extends ObjectBehavior
{
    /**
     * @var Generator
     */
    private $seeder;

    /**
     * @var Currency
     */
    private $currency;

    /**
     * @var int
     */
    private $amount;

    public function __construct()
    {
        $this->seeder = Factory::create();
    }

    public function let(Currency $currency)
    {
        $this->beConstructedWith(
            $this->amount = $this->seeder->numberBetween(0.1,10.99),
            $this->currency = $currency
        );
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(Money::class);
    }

    public function it_has_currency()
    {
        $this->currency()->shouldReturn($this->currency);
    }

    public function it_has_amount()
    {
        $this->amount()->shouldReturn($this->amount);
    }

    public function it_can_be_incremented()
    {
        $incrementBy = $this->seeder->numberBetween(0.1,10.99);
        $newValue = intval($this->amount + $incrementBy);

        $this->incrementBy($incrementBy)->shouldHaveType(Money::class);
        $this->incrementBy($incrementBy)->amount()->shouldReturn($newValue);
    }

    public function it_can_be_decremented()
    {
        $decrementBy = $this->seeder->numberBetween(0.1,10.99);
        $newValue = intval($this->amount - $decrementBy);

        $this->decrementBy($decrementBy)->shouldHaveType(Money::class);
        $this->decrementBy($decrementBy)->amount()->shouldReturn($newValue);
    }

    public function it_can_be_multiplied()
    {
        $multiplyBy = $this->seeder->numberBetween(0.1,10.99);
        $newValue = intval($this->amount * $multiplyBy);

        $this->multiplyBy($multiplyBy)->shouldHaveType(Money::class);
        $this->multiplyBy($multiplyBy)->amount()->shouldReturn($newValue);
    }

    public function it_can_be_divided()
    {
        $divideBy = $this->seeder->numberBetween(1,10.99);
        $newValue = intval($this->amount / $divideBy);

        $this->divideBy($divideBy)->shouldHaveType(Money::class);
        $this->divideBy($divideBy)->amount()->shouldReturn($newValue);
    }

    public function it_can_be_converted(Currency $newCurrency)
    {
        $exchangeRate =  $this->seeder->numberBetween(10.1,10.99);
        $newValue = intval($this->amount * $exchangeRate);

        $this->convertTo($newCurrency, $exchangeRate)->shouldHaveType(Money::class);
        $this->convertTo($newCurrency, $exchangeRate)->amount()->shouldReturn($newValue);
        $this->convertTo($newCurrency, $exchangeRate)->currency()->shouldReturn($newCurrency);
    }
}
