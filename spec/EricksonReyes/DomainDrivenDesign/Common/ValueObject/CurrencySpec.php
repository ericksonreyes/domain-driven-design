<?php

namespace spec\EricksonReyes\DomainDrivenDesign\Common\ValueObject;

use EricksonReyes\DomainDrivenDesign\Common\ValueObject\Currency;
use EricksonReyes\DomainDrivenDesign\Common\ValueObject\Exception\InvalidCurrencyCodeError;
use PhpSpec\ObjectBehavior;
use spec\EricksonReyes\DomainDrivenDesign\Common\UnitTestTrait;

class CurrencySpec extends ObjectBehavior
{
    use UnitTestTrait;

    private $currency;

    public function let()
    {
        $this->beConstructedWith(
            $this->currency = $this->seeder->currencyCode
        );
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(Currency::class);
    }

    public function it_only_requires_only_letters()
    {
        $this->shouldThrow(InvalidCurrencyCodeError::class)->during(
            '__construct',
            [
                'A2S'
            ]
        );
    }

    public function it_only_requires_three_letters()
    {
        $this->shouldThrow(InvalidCurrencyCodeError::class)->during(
            '__construct',
            [
                'US'
            ]
        );
    }

    public function it_has_string_representation()
    {
        $this->__toString()->shouldReturn($this->currency);
    }

    public function it_can_be_compared()
    {
        $anotherCurrency = new Currency($this->currency);
        $this->matches($anotherCurrency)->shouldReturn(true);
        $this->doesNotMatch($anotherCurrency)->shouldReturn(false);
    }

    public function it_can_compare_mismatches()
    {
        $anotherCurrency = new Currency($this->seeder->currencyCode);
        $this->matches($anotherCurrency)->shouldReturn(false);
        $this->doesNotMatch($anotherCurrency)->shouldReturn(true);
    }
}
