<?php

namespace spec\EricksonReyes\DomainDrivenDesign\Common\ValueObject;

use EricksonReyes\DomainDrivenDesign\Common\Attributes\ValueObject;
use EricksonReyes\DomainDrivenDesign\Common\ValueObject\Address;
use EricksonReyes\DomainDrivenDesign\Common\ValueObject\Country;
use PhpSpec\ObjectBehavior;
use spec\EricksonReyes\DomainDrivenDesign\Common\UnitTestTrait;

class AddressSpec extends ObjectBehavior
{
    use UnitTestTrait;

    /**
     * @var Country
     */
    private $country;

    /**
     * @var string
     */
    private $street;

    /**
     * @var string
     */
    private $city;

    /**
     * @var string
     */
    private $state;

    /**
     * @var string
     */
    private $zipCode;

    public function let(Country $country)
    {
        $this->beConstructedWith(
            $this->street = $this->seeder->streetAddress,
            $this->city = $this->seeder->city,
            $this->state = $this->seeder->word,
            $this->country = $country,
            $this->zipCode = $this->seeder->postcode
        );
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(Address::class);
        $this->shouldHaveType(ValueObject::class);
    }

    public function it_has_street()
    {
        $this->street()->shouldReturn($this->street);
    }

    public function it_has_city()
    {
        $this->city()->shouldReturn($this->city);
    }

    public function it_has_state()
    {
        $this->state()->shouldReturn($this->state);
    }

    public function it_has_country()
    {
        $this->country()->shouldReturn($this->country);
    }

    public function it_has_zip_code()
    {
        $this->zipCode()->shouldReturn($this->zipCode);
    }

    public function it_has_array_representation()
    {
        $expectedCountryArray = $this->seeder->paragraphs;
        $this->country->toArray()->shouldBeCalled()->willReturn($expectedCountryArray);

        $this->toArray()->shouldReturn([
            'street' => $this->street,
            'city' => $this->city,
            'state' => $this->state,
            'country' => $expectedCountryArray,
            'zipCode' => $this->zipCode
        ]);
    }

    public function it_can_be_matched(Address $sameAddress)
    {
        $sameAddress->street()->shouldBeCalled()->willReturn($this->street);
        $sameAddress->city()->shouldBeCalled()->willReturn($this->city);
        $sameAddress->state()->shouldBeCalled()->willReturn($this->state);
        $sameAddress->country()->shouldBeCalled()->willReturn($this->country);
        $sameAddress->zipCode()->shouldBeCalled()->willReturn($this->zipCode);

        $this->country->matches($this->country)->shouldBeCalled()->willReturn(true);
        $this->matches($sameAddress)->shouldReturn(true);
    }

    public function it_can_be_mismatched(Address $aDifferentAddress)
    {
        $aDifferentAddress->street()->shouldBeCalled()->willReturn($this->street);
        $aDifferentAddress->city()->shouldBeCalled()->willReturn($this->city);
        $aDifferentAddress->state()->shouldBeCalled()->willReturn($this->state);
        $aDifferentAddress->country()->shouldBeCalled()->willReturn($this->country);
        $aDifferentAddress->zipCode()->shouldBeCalled()->willReturn($this->zipCode);

        $this->country->matches($this->country)->shouldBeCalled()->willReturn(false);
        $this->doesNotMatch($aDifferentAddress)->shouldReturn(true);
    }
}
