<?php

namespace spec\EricksonReyes\DomainDrivenDesign\Common\ValueObject\Address;

use EricksonReyes\DomainDrivenDesign\Common\ValueObject\Address\Address;
use EricksonReyes\DomainDrivenDesign\Common\ValueObject\Address\City;
use EricksonReyes\DomainDrivenDesign\Common\ValueObject\Address\CountryCode;
use EricksonReyes\DomainDrivenDesign\Common\ValueObject\Address\State;
use EricksonReyes\DomainDrivenDesign\Common\ValueObject\Address\Street;
use EricksonReyes\DomainDrivenDesign\Common\ValueObject\Address\ZipCode;
use PhpSpec\ObjectBehavior;
use spec\EricksonReyes\DomainDrivenDesign\Common\UnitTestTrait;

class AddressSpec extends ObjectBehavior
{
    use UnitTestTrait;

    /**
     * @var Street
     */
    private $street;

    /**
     * @var City
     */
    private $city;

    /**
     * @var State
     */
    private $state;

    /**
     * @var CountryCode
     */
    private $countryCode;

    /**
     * @var ZipCode
     */
    private $zipCode;

    /**
     * AddressSpec constructor.
     * @param Street $street
     * @param City $city
     * @param State $state
     * @param CountryCode $countryCode
     * @param ZipCode $zipCode
     */
    public function let(Street $street, City $city, State $state, CountryCode $countryCode, ZipCode $zipCode)
    {
        $this->beConstructedWith(
            $this->street = $street,
            $this->city = $city,
            $this->state = $state,
            $this->countryCode = $countryCode,
            $this->zipCode = $zipCode
        );
    }


    public function it_is_initializable()
    {
        $this->shouldHaveType(Address::class);
    }

    public function it_has_a_street()
    {
        $this->street()->shouldReturn($this->street);
    }

    public function it_has_a_city()
    {
        $this->city()->shouldReturn($this->city);
    }

    public function it_has_a_state()
    {
        $this->state()->shouldReturn($this->state);
    }

    public function it_has_a_country_code()
    {
        $this->countryCode()->shouldReturn($this->countryCode);
    }

    public function it_has_a_zip_code()
    {
        $this->zipCode()->shouldReturn($this->zipCode);
    }

    public function it_can_be_matched()
    {
        $this->matches($this)->shouldReturn(true);
    }

    public function it_can_compare_streets(Address $anotherAddress) {
        $aDifferentStreet = new Street($this->seeder->streetAddress);
        $anotherAddress->street()->shouldBeCalled()->willReturn($aDifferentStreet);
        $this->matches($anotherAddress)->shouldReturn(false);
    }

    public function it_can_compare_cities(Address $anotherAddress) {
        $anotherAddress->street()->shouldBeCalled()->willReturn($this->street());

        $aDifferentCity = new City($this->seeder->city);
        $anotherAddress->city()->shouldBeCalled()->willReturn($aDifferentCity);
        $this->matches($anotherAddress)->shouldReturn(false);
    }

    public function it_can_compare_states(Address $anotherAddress) {
        $anotherAddress->street()->shouldBeCalled()->willReturn($this->street());
        $anotherAddress->city()->shouldBeCalled()->willReturn($this->city());

        $aDifferentState = new State($this->seeder->word);
        $anotherAddress->state()->shouldBeCalled()->willReturn($aDifferentState);
        $this->matches($anotherAddress)->shouldReturn(false);
    }

    public function it_can_compare_country_codes(Address $anotherAddress) {
        $anotherAddress->street()->shouldBeCalled()->willReturn($this->street());
        $anotherAddress->city()->shouldBeCalled()->willReturn($this->city());
        $anotherAddress->state()->shouldBeCalled()->willReturn($this->state());

        $aDifferentCountryCode = new CountryCode($this->seeder->countryISOAlpha3);
        $anotherAddress->countryCode()->shouldBeCalled()->willReturn($aDifferentCountryCode);
        $this->matches($anotherAddress)->shouldReturn(false);
    }

    public function it_can_compare_zip_codes(Address $anotherAddress) {
        $anotherAddress->street()->shouldBeCalled()->willReturn($this->street());
        $anotherAddress->city()->shouldBeCalled()->willReturn($this->city());
        $anotherAddress->state()->shouldBeCalled()->willReturn($this->state());
        $anotherAddress->countryCode()->shouldBeCalled()->willReturn($this->countryCode());

        $aDifferentZipCode = new ZipCode($this->seeder->postcode);
        $anotherAddress->zipCode()->shouldBeCalled()->willReturn($aDifferentZipCode);
        $this->matches($anotherAddress)->shouldReturn(false);
    }
}
