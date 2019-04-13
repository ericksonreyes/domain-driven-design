<?php

namespace spec\EricksonReyes\DomainDrivenDesign\Common\ValueObject;

use EricksonReyes\DomainDrivenDesign\Common\Attributes\ValueObject;
use EricksonReyes\DomainDrivenDesign\Common\ValueObject\Currency;
use EricksonReyes\DomainDrivenDesign\Common\ValueObject\Exception\EmptyCurrencyCodeException;
use EricksonReyes\DomainDrivenDesign\Common\ValueObject\Exception\EmptyCurrencyNameException;
use PhpSpec\ObjectBehavior;
use spec\EricksonReyes\DomainDrivenDesign\Common\UnitTestTrait;

class CurrencySpec extends ObjectBehavior
{
    use UnitTestTrait;

    /**
     * @var string
     */
    private $code;

    /**
     * @var string
     */
    private $name;

    public function let()
    {
        $this->beConstructedWith(
            $this->code = $this->seeder->currencyCode,
            $this->name = $this->seeder->word
        );
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(Currency::class);
        $this->shouldHaveType(ValueObject::class);
    }

    public function it_has_currency_code()
    {
        $this->code()->shouldReturn($this->code);
    }

    public function it_has_currency_name()
    {
        $this->name()->shouldReturn($this->name);
    }

    public function it_has_an_array_representation()
    {
        $this->toArray()->shouldReturn([
            'code' => $this->code,
            'name' => $this->name
        ]);
    }

    public function it_does_not_accept_empty_currency_code_and_name()
    {
        $this->shouldThrow(EmptyCurrencyCodeException::class)->during(
            '__construct',
            [
                str_repeat(' ', mt_rand(1, 10)),
                $this->name
            ]
        );

        $this->shouldThrow(EmptyCurrencyNameException::class)->during(
            '__construct',
            [
                $this->code,
                str_repeat(' ', mt_rand(1, 10))
            ]
        );
    }

    public function it_can_be_matched(Currency $sameCurrency)
    {
        $this->beConstructedWith('PHP', 'PESO');

        $sameCurrency->code()->shouldBeCalled()->willReturn('PHP');
        $sameCurrency->name()->shouldBeCalled()->willReturn('PESO');
        $this->matches($sameCurrency)->shouldReturn(true);
        $this->doesNotMatch($sameCurrency)->shouldReturn(false);
    }

    public function it_can_be_mismatched(Currency $aDifferentCurrency)
    {
        $this->beConstructedWith('PHP', 'PESO');

        $aDifferentCurrency->code()->shouldBeCalled()->willReturn('MXN');
        $aDifferentCurrency->name()->shouldBeCalled()->willReturn('PESO');
        $this->matches($aDifferentCurrency)->shouldReturn(false);
        $this->doesNotMatch($aDifferentCurrency)->shouldReturn(true);
    }
}
