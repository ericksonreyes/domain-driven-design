<?php

namespace spec\EricksonReyes\DomainDrivenDesign\Common\ValueObject;

use EricksonReyes\DomainDrivenDesign\Common\Attributes\ValueObject;
use EricksonReyes\DomainDrivenDesign\Common\ValueObject\Exception\LongPhoneNumberException;
use EricksonReyes\DomainDrivenDesign\Common\ValueObject\Exception\NegativeAreaCodeException;
use EricksonReyes\DomainDrivenDesign\Common\ValueObject\Exception\NegativeCountryCodeException;
use EricksonReyes\DomainDrivenDesign\Common\ValueObject\Exception\NegativeExtensionNumberException;
use EricksonReyes\DomainDrivenDesign\Common\ValueObject\Exception\NegativePhoneNumberException;
use EricksonReyes\DomainDrivenDesign\Common\ValueObject\Exception\ShortPhoneNumberException;
use EricksonReyes\DomainDrivenDesign\Common\ValueObject\Exception\ZeroAreaCodeException;
use EricksonReyes\DomainDrivenDesign\Common\ValueObject\Exception\ZeroCountryCodeException;
use EricksonReyes\DomainDrivenDesign\Common\ValueObject\Exception\ZeroPhoneNumberException;
use EricksonReyes\DomainDrivenDesign\Common\ValueObject\PhoneNumber;
use PhpSpec\ObjectBehavior;
use spec\EricksonReyes\DomainDrivenDesign\Common\UnitTestTrait;

class PhoneNumberSpec extends ObjectBehavior
{
    use UnitTestTrait;

    /**
     * @var int
     */
    private $countryCode;

    /**
     * @var int
     */
    private $areaCode;

    /**
     * @var int
     */
    private $phoneNumber;

    /**
     * @var int
     */
    private $extensionNumber;

    public function let()
    {
        $this->beConstructedWith(
            $this->phoneNumber = $this->seeder->numberBetween(1000000, 9999999)
        );
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(PhoneNumber::class);
        $this->shouldHaveType(ValueObject::class);
    }

    public function it_has_phone_number()
    {
        $this->phoneNumber()->shouldReturn($this->phoneNumber);
    }

    public function it_can_be_created_with_country_and_area_code()
    {
        $phoneWithCountryAndAreaCode = $this::createWithCountryAndAreaCode(
            $this->countryCode = $this->seeder->numberBetween(10, 99),
            $this->areaCode = $this->seeder->numberBetween(1, 999),
            $this->phoneNumber
        );

        $phoneWithCountryAndAreaCode->countryCode()->shouldReturn($this->countryCode);
        $phoneWithCountryAndAreaCode->areaCode()->shouldReturn($this->areaCode);
        $phoneWithCountryAndAreaCode->phoneNumber()->shouldReturn($this->phoneNumber);
    }

    public function it_does_not_accept_zero_numbers()
    {
        $this->countryCode = $this->seeder->numberBetween(10, 99);
        $this->areaCode = $this->seeder->numberBetween(1, 999);

        $this->shouldThrow(ZeroCountryCodeException::class)->during(
            'createWithCountryAndAreaCode',
            [
                0,
                $this->areaCode,
                $this->phoneNumber
            ]
        );

        $this->shouldThrow(ZeroAreaCodeException::class)->during(
            'createWithCountryAndAreaCode',
            [
                $this->countryCode,
                0,
                $this->phoneNumber
            ]
        );

        $this->shouldThrow(ZeroPhoneNumberException::class)->during(
            'createWithCountryAndAreaCode',
            [
                $this->countryCode,
                $this->areaCode,
                0
            ]
        );

        $this->shouldThrow(ZeroPhoneNumberException::class)->during(
            '__construct',
            [
                0
            ]
        );
    }

    public function it_does_not_accept_negative_numbers()
    {
        $this->countryCode = $this->seeder->numberBetween(10, 99);
        $this->areaCode = $this->seeder->numberBetween(1, 999);


        $this->shouldThrow(NegativeExtensionNumberException::class)->during(
            'withExtensionNumber',
            [
                $this->seeder->numberBetween(-9999999, -1000000)
            ]
        );

        $this->shouldThrow(NegativeCountryCodeException::class)->during(
            'createWithCountryAndAreaCode',
            [
                $this->seeder->numberBetween(-99, -1),
                $this->areaCode,
                $this->phoneNumber
            ]
        );

        $this->shouldThrow(NegativeAreaCodeException::class)->during(
            'createWithCountryAndAreaCode',
            [
                $this->countryCode,
                $this->seeder->numberBetween(-999, -1),
                $this->phoneNumber
            ]
        );

        $this->shouldThrow(NegativePhoneNumberException::class)->during(
            'createWithCountryAndAreaCode',
            [
                $this->countryCode,
                $this->areaCode,
                $this->seeder->numberBetween(-9999999, -1000000),
            ]
        );

        $this->shouldThrow(NegativePhoneNumberException::class)->during(
            '__construct',
            [
                $this->seeder->numberBetween(-9999999, -1000000),
            ]
        );
    }

    public function it_can_have_an_extension_number()
    {
        $expectedExtensionNumber = $this->seeder->numberBetween(1, 999);

        $this->withExtensionNumber($expectedExtensionNumber)->shouldHaveType(PhoneNumber::class);
        $this->withExtensionNumber($expectedExtensionNumber)->phoneNumber()->shouldReturn($this->phoneNumber);
        $this->withExtensionNumber($expectedExtensionNumber)->extensionNumber()->shouldReturn($expectedExtensionNumber);
    }

    public function it_does_not_accept_short_phone_numbers()
    {
        $this->shouldThrow(ShortPhoneNumberException::class)->during(
            '__construct',
            [$this->seeder->numberBetween(1, 999)]
        );
    }

    public function it_does_not_accept_long_phone_numbers()
    {
        $this->shouldThrow(LongPhoneNumberException::class)->during(
            '__construct',
            [$this->seeder->numberBetween(10000000, 90000000)]
        );
    }

    public function it_can_be_compared(PhoneNumber $anotherPhoneNumber, PhoneNumber $aDifferentPhoneNumber)
    {
        $anotherPhoneNumber->countryCode()->shouldBeCalled()->willReturn($this->countryCode);
        $anotherPhoneNumber->areaCode()->shouldBeCalled()->willReturn($this->areaCode);
        $anotherPhoneNumber->phoneNumber()->shouldBeCalled()->willReturn($this->phoneNumber);
        $anotherPhoneNumber->extensionNumber()->shouldBeCalled()->willReturn($this->extensionNumber);
        $this->matches($anotherPhoneNumber)->shouldReturn(true);
        $this->doesNotMatch($anotherPhoneNumber)->shouldReturn(false);

        $aDifferentPhoneNumber->phoneNumber()->shouldBeCalled()->willReturn($this->seeder->numberBetween(10000000, 90000000));
        $this->matches($aDifferentPhoneNumber)->shouldReturn(false);
        $this->doesNotMatch($aDifferentPhoneNumber)->shouldReturn(true);

        $aDifferentPhoneNumber->areaCode()->shouldBeCalled()->willReturn(mt_rand(-999, -1));
        $aDifferentPhoneNumber->phoneNumber()->shouldBeCalled()->willReturn($this->phoneNumber);
        $this->matches($aDifferentPhoneNumber)->shouldReturn(false);
        $this->doesNotMatch($aDifferentPhoneNumber)->shouldReturn(true);

        $aDifferentPhoneNumber->countryCode()->shouldBeCalled()->willReturn(mt_rand(-99, -1));
        $aDifferentPhoneNumber->areaCode()->shouldBeCalled()->willReturn($this->areaCode);
        $aDifferentPhoneNumber->phoneNumber()->shouldBeCalled()->willReturn($this->phoneNumber);
        $this->matches($aDifferentPhoneNumber)->shouldReturn(false);
        $this->doesNotMatch($aDifferentPhoneNumber)->shouldReturn(true);
    }

    public function it_has_an_array_representation()
    {
        $this->toArray()->shouldReturn([
            'countryCode' => $this->countryCode,
            'areaCode' => $this->areaCode,
            'phoneNumber' => $this->phoneNumber,
            'extensionNumber' => $this->extensionNumber
        ]);
    }
}
