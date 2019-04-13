<?php

namespace spec\EricksonReyes\DomainDrivenDesign\Common\ValueObject;

use EricksonReyes\DomainDrivenDesign\Common\Attributes\ValueObject;
use EricksonReyes\DomainDrivenDesign\Common\ValueObject\Country;
use EricksonReyes\DomainDrivenDesign\Common\ValueObject\Exception\InvalidCountryISO2CodeException;
use EricksonReyes\DomainDrivenDesign\Common\ValueObject\Exception\InvalidCountryISO3CodeException;
use EricksonReyes\DomainDrivenDesign\Common\ValueObject\Exception\InvalidCountryNameException;
use PhpSpec\ObjectBehavior;
use spec\EricksonReyes\DomainDrivenDesign\Common\UnitTestTrait;

class CountrySpec extends ObjectBehavior
{
    use UnitTestTrait;

    /**
     * @var string
     */
    private $iso2Code;

    /**
     * @var string
     */
    private $iso3Code;

    /**
     * @var string
     */
    private $name;

    public function let()
    {
        $this->beConstructedWith(
            $this->iso2Code = $this->seeder->countryCode,
            $this->iso3Code = $this->seeder->countryISOAlpha3,
            $this->name = $this->seeder->country
        );
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(Country::class);
        $this->shouldHaveType(ValueObject::class);
    }

    public function it_has_country_iso_alpha2_code()
    {
        $this->iso2Code()->shouldReturn($this->iso2Code);
    }

    public function it_has_country_iso_alpha3_code()
    {
        $this->iso3Code()->shouldReturn($this->iso3Code);
    }

    public function it_has_country_name()
    {
        $this->name()->shouldReturn($this->name);
    }

    public function it_rejects_invalid_iso2_codes()
    {
        $this->shouldThrow(InvalidCountryISO2CodeException::class)->during(
            '__construct',
            [
                $this->seeder->word,
                $this->iso3Code,
                $this->name
            ]
        );
    }

    public function it_rejects_invalid_iso3_codes()
    {
        $this->shouldThrow(InvalidCountryISO3CodeException::class)->during(
            '__construct',
            [
                $this->iso2Code,
                $this->seeder->word,
                $this->name
            ]
        );
    }

    public function it_rejects_invalid_country_name()
    {
        $this->shouldThrow(InvalidCountryNameException::class)->during(
            '__construct',
            [
                $this->iso2Code,
                $this->iso3Code,
                str_repeat(' ', $this->seeder->numberBetween(1, 10))
            ]
        );
    }

    public function it_has_array_representation()
    {
        $this->toArray()->shouldReturn([
            'iso2Code' => $this->iso2Code,
            'iso3Code' => $this->iso3Code,
            'name' => $this->name
        ]);

    }

    public function it_can_be_matched(Country $sameCountry)
    {
        $sameCountry->iso2Code()->shouldBeCalled()->willReturn($this->iso2Code);
        $sameCountry->iso3Code()->shouldBeCalled()->willReturn($this->iso3Code);
        $sameCountry->name()->shouldBeCalled()->willReturn($this->name);
        $this->matches($sameCountry)->shouldReturn(true);
        $this->doesNotMatch($sameCountry)->shouldReturn(false);
    }

    public function it_can_be_mismatched(Country $aDifferentCountry)
    {
        $aDifferentCountry->iso2Code()->shouldBeCalled()->willReturn($this->seeder->countryCode);
        $this->matches($aDifferentCountry)->shouldReturn(false);
        $this->doesNotMatch($aDifferentCountry)->shouldReturn(true);
    }
}
