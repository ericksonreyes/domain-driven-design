<?php

namespace spec\EricksonReyes\DomainDrivenDesign\Common\Factory;

use EricksonReyes\DomainDrivenDesign\Common\Factory\CountryFactory;
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
        foreach ($this->getWrappedObject()::COUNTRIES as $iso2Code => $country) {
            $this::create($iso2Code)->shouldHaveType(Country::class);
            $this::create($iso2Code)->iso2Code()->shouldReturn($country['ISO']);
            $this::create($iso2Code)->iso3Code()->shouldReturn($country['ISO3']);
            $this::create($iso2Code)->name()->shouldReturn($country['Country']);
        }

        $this::create($this->seeder->word)->shouldBeNull();
    }
}
