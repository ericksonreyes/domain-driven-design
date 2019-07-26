<?php

namespace spec\EricksonReyes\DomainDrivenDesign\Common\Factory;

use EricksonReyes\DomainDrivenDesign\Common\Factory\PhoneFactory;
use EricksonReyes\DomainDrivenDesign\Common\ValueObject\PhoneNumber;
use PhpSpec\ObjectBehavior;
use spec\EricksonReyes\DomainDrivenDesign\Common\UnitTestTrait;

class PhoneFactorySpec extends ObjectBehavior
{
    use UnitTestTrait;

    public function it_is_initializable()
    {
        $this->shouldHaveType(PhoneFactory::class);
    }


    public function it_can_create_basic_phone_numbers()
    {
        $expectedPhoneNumber = (int)$this->seeder->numberBetween(10000, 9999999);
        $this::create($expectedPhoneNumber)->shouldHaveType(PhoneNumber::class);
    }

    public function it_can_create_fully_formatted_phone_numbers()
    {
        $expectedAreaCode = (int)$this->seeder->numberBetween(1, 100000);
        $expectedPhoneNumber = (int)$this->seeder->numberBetween(10000, 9999999);
        $expectedCountryCode = (int)$this->seeder->numberBetween(1, 10000);

        $this::create(
            $expectedPhoneNumber,
            $expectedCountryCode,
            $expectedAreaCode
        )->shouldHaveType(PhoneNumber::class);

        $this::create(
            $expectedPhoneNumber,
            $expectedCountryCode,
            null
        )->shouldHaveType(PhoneNumber::class);
    }
}
