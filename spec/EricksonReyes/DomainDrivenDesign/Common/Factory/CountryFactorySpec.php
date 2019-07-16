<?php

namespace spec\EricksonReyes\DomainDrivenDesign\Common\Factory;

use EricksonReyes\DomainDrivenDesign\Common\Factory\CountryFactory;
use EricksonReyes\DomainDrivenDesign\Common\Factory\Exception\InvalidCountryISO2CodeException;
use EricksonReyes\DomainDrivenDesign\Common\ValueObject\Country;
use PhpSpec\ObjectBehavior;
use spec\EricksonReyes\DomainDrivenDesign\Common\UnitTestTrait;

class CountryFactorySpec extends ObjectBehavior
{
    use UnitTestTrait;

    public function it_is_initializable()
    {
        $this->shouldHaveType(CountryFactory::class);
    }


    public function it_can_create_countries()
    {
        $countries = CountryFactory::COUNTRIES;
        foreach ($countries as $iso2Code => $country) {
            $this::create($iso2Code)->shouldHaveType(Country::class);
            $this::create($iso2Code)->iso2Code()->shouldReturn($country['ISO']);
            $this::create($iso2Code)->iso3Code()->shouldReturn($country['ISO3']);
            $this::create($iso2Code)->name()->shouldReturn($country['Country']);
        }
    }

    public function it_validates_country_codes()
    {
        $this::validate($this->seeder->word)->shouldReturn(false);

        $countries = CountryFactory::COUNTRIES;
        foreach ($countries as $iso2Code => $country) {
            $this::validate($iso2Code)->shouldReturn(true);
        }
    }

    public function it_prevents_the_creation_of_country_object_from_invalid_iso2_code()
    {
        $this->shouldThrow(InvalidCountryISO2CodeException::class)
            ->during('create',
                [
                    $this->seeder->word
                ]);
    }
}
