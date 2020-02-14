<?php

namespace spec\EricksonReyes\DomainDrivenDesign\Common\ValueObject\Address;

use EricksonReyes\DomainDrivenDesign\Common\ValueObject\Address\Address;
use EricksonReyes\DomainDrivenDesign\Common\ValueObject\Address\City;
use EricksonReyes\DomainDrivenDesign\Common\ValueObject\Address\CountryCode;
use EricksonReyes\DomainDrivenDesign\Common\ValueObject\Address\State;
use EricksonReyes\DomainDrivenDesign\Common\ValueObject\Address\Street;
use EricksonReyes\DomainDrivenDesign\Common\ValueObject\Address\ZipCode;
use PhpSpec\ObjectBehavior;

class AddressSpec extends ObjectBehavior
{
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
}
