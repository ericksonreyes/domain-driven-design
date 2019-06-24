<?php

namespace spec\EricksonReyes\DomainDrivenDesign\Common\Factory;

use EricksonReyes\DomainDrivenDesign\Common\Factory\AddressFactory;
use EricksonReyes\DomainDrivenDesign\Common\ValueObject\Address;
use PhpSpec\ObjectBehavior;
use spec\EricksonReyes\DomainDrivenDesign\Common\UnitTestTrait;

class AddressFactorySpec extends ObjectBehavior
{
    use UnitTestTrait;

    public function it_is_initializable()
    {
        $this->shouldHaveType(AddressFactory::class);
    }

    public function it_can_create_an_address_object()
    {
        $this::create(
            $this->seeder->streetAddress,
            $this->seeder->city,
            $this->seeder->word,
            $this->seeder->countryCode,
            $this->seeder->postcode
        )->shouldHaveType(Address::class);
    }

}
