<?php

namespace spec\EricksonReyes\DomainDrivenDesign\Common\ValueObject;

use EricksonReyes\DomainDrivenDesign\Common\ValueObject\PhoneNumber;
use EricksonReyes\EricksonReyes\DomainDrivenDesign\Common\ValueObject\Exception\NegativeAreaCodeException;
use EricksonReyes\EricksonReyes\DomainDrivenDesign\Common\ValueObject\Exception\NegativeCountryCodeException;
use EricksonReyes\EricksonReyes\DomainDrivenDesign\Common\ValueObject\Exception\NegativeExtensionNumberException;
use EricksonReyes\EricksonReyes\DomainDrivenDesign\Common\ValueObject\Exception\NegativePhoneNumberException;
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
            $this->countryCode = $this->generateCountryCode(),
            $this->areaCode = $this->generateAreaCode(),
            $this->phoneNumber = $this->generatePhoneNumber()
        );
        $this->extensionNumber = mt_rand(0, 9);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(PhoneNumber::class);
    }

    public function it_has_country_code()
    {
        $this->countryCode()->shouldReturn($this->countryCode);
    }

    public function it_has_area_code()
    {
        $this->areaCode()->shouldReturn($this->areaCode);
    }

    public function it_has_phone_number()
    {
        $this->phoneNumber()->shouldReturn($this->phoneNumber);
    }

    public function it_does_not_have_an_extension_number_by_default()
    {
        $this->extensionNumber()->shouldBeNull();
    }

    public function it_can_have_an_extension_number()
    {
        $this->withExtensionNumber($this->extensionNumber)->shouldHaveType(PhoneNumber::class);
        $this->extensionNumber()->shouldBeNull();

        $this->withExtensionNumber($this->extensionNumber)->countryCode()->shouldReturn($this->countryCode);
        $this->withExtensionNumber($this->extensionNumber)->areaCode()->shouldReturn($this->areaCode);
        $this->withExtensionNumber($this->extensionNumber)->phoneNumber()->shouldReturn($this->phoneNumber);
        $this->withExtensionNumber($this->extensionNumber)->extensionNumber()->shouldReturn($this->extensionNumber);
    }

    public function it_does_not_accept_negative_numbers()
    {
        $negativeCountryCode = 0 - $this->generateCountryCode();
        $negativeAreaCode = 0 - $this->generateAreaCode();
        $negativePhoneNumber = 0 - $this->generatePhoneNumber();
        $negativeExtensionNumber = 0 - mt_rand(1, 9);

        $this->shouldThrow(NegativeCountryCodeException::class)->during(
            '__construct',
            [
                $negativeCountryCode,
                $this->generateAreaCode(),
                $this->generatePhoneNumber()
            ]
        );

        $this->shouldThrow(NegativeAreaCodeException::class)->during(
            '__construct',
            [
                $this->generateCountryCode(),
                $negativeAreaCode,
                $this->generatePhoneNumber()
            ]
        );

        $this->shouldThrow(NegativePhoneNumberException::class)->during(
            '__construct',
            [
                $this->generateCountryCode(),
                $this->generateAreaCode(),
                $negativePhoneNumber
            ]
        );

        $this->beConstructedWith(
            $this->countryCode = $this->generateCountryCode(),
            $this->areaCode = $this->generateAreaCode(),
            $this->phoneNumber = $this->generatePhoneNumber()
        );

        $this->shouldThrow(NegativeExtensionNumberException::class)->during(
            'withExtensionNumber',
            [
                $negativeExtensionNumber
            ]
        );
    }

    public function it_can_compare_matching_phone_numbers(PhoneNumber $phoneNumber)
    {
        $matchingExtensionNumber = mt_rand(0, 5);

        $phoneNumber->countryCode()->shouldBeCalled()->willReturn($this->countryCode);
        $phoneNumber->areaCode()->shouldBeCalled()->willReturn($this->areaCode);
        $phoneNumber->phoneNumber()->shouldBeCalled()->willReturn($this->phoneNumber);
        $phoneNumber->extensionNumber()->shouldBeCalled()->willReturn($matchingExtensionNumber);

        $this->withExtensionNumber($matchingExtensionNumber)->matches($phoneNumber)->shouldReturn(true);
        $this->withExtensionNumber($matchingExtensionNumber)->doesNotMatch($phoneNumber)->shouldReturn(false);
    }

    public function it_can_compare_mismatched_phone_numbers(PhoneNumber $phoneNumber)
    {
        $phoneNumber->countryCode()->shouldBeCalled()->willReturn($this->generateCountryCode());
        $this->matches($phoneNumber)->shouldReturn(false);

        $phoneNumber->countryCode()->shouldBeCalled()->willReturn($this->countryCode);
        $phoneNumber->areaCode()->shouldBeCalled()->willReturn($this->generateAreaCode());
        $this->matches($phoneNumber)->shouldReturn(false);

        $phoneNumber->countryCode()->shouldBeCalled()->willReturn($this->countryCode);
        $phoneNumber->areaCode()->shouldBeCalled()->willReturn($this->areaCode);
        $phoneNumber->phoneNumber()->shouldBeCalled()->willReturn($this->generatePhoneNumber());
        $this->matches($phoneNumber)->shouldReturn(false);

        $phoneNumber->countryCode()->shouldBeCalled()->willReturn($this->countryCode);
        $phoneNumber->areaCode()->shouldBeCalled()->willReturn($this->areaCode);
        $phoneNumber->phoneNumber()->shouldBeCalled()->willReturn($this->phoneNumber);
        $phoneNumber->extensionNumber()->shouldBeCalled()->willReturn(mt_rand(6, 9));

        $this->withExtensionNumber(mt_rand(0, 5))->matches($phoneNumber)->shouldReturn(false);
        $this->withExtensionNumber(mt_rand(0, 5))->doesNotMatch($phoneNumber)->shouldReturn(true);
    }

    /**
     * @return int
     */
    private function generateCountryCode(): int
    {
        return mt_rand(1, 99);
    }

    /**
     * @return int
     */
    private function generateAreaCode(): int
    {
        return mt_rand(1, 999);
    }

    /**
     * @return int
     */
    private function generatePhoneNumber(): int
    {

        return mt_rand(1000000, 9999999);
    }

}
