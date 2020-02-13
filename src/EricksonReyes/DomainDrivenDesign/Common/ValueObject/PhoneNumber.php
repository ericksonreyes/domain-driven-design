<?php

namespace EricksonReyes\DomainDrivenDesign\Common\ValueObject;

use EricksonReyes\DomainDrivenDesign\Common\ValueObject\Exception\NegativeAreaCodeException;
use EricksonReyes\DomainDrivenDesign\Common\ValueObject\Exception\NegativeCountryCodeException;
use EricksonReyes\DomainDrivenDesign\Common\ValueObject\Exception\NegativeExtensionNumberException;
use EricksonReyes\DomainDrivenDesign\Common\ValueObject\Exception\NegativePhoneNumberException;
use i;

class PhoneNumber
{
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

    /**
     * PhoneNumber constructor.
     * @param int $countryCode
     * @param int $areaCode
     * @param int $phoneNumber
     */
    public function __construct(int $countryCode, int $areaCode, int $phoneNumber)
    {
        if ($countryCode < 0) {
            throw new NegativeCountryCodeException(
                'Country code (' . $countryCode . ') must not be negative number.'
            );
        }

        if ($areaCode < 0) {
            throw new NegativeAreaCodeException(
                'Area code (' . $areaCode . ') must not be negative number.'
            );
        }

        if ($phoneNumber < 0) {
            throw new NegativePhoneNumberException(
                'Phone number (' . $phoneNumber . ') must not be negative number.'
            );
        }

        $this->countryCode = $countryCode;
        $this->areaCode = $areaCode;
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * @return int
     */
    public function countryCode(): int
    {
        return $this->countryCode;
    }

    /**
     * @return int
     */
    public function areaCode(): int
    {
        return $this->areaCode;
    }

    /**
     * @return int
     */
    public function phoneNumber(): int
    {
        return $this->phoneNumber;
    }

    /**
     * @return int|null
     */
    public function extensionNumber(): ?int
    {
        return $this->extensionNumber;
    }

    /**
     * @param int $extensionNumber
     * @return $this
     */
    public function withExtensionNumber(int $extensionNumber): PhoneNumber
    {
        if ($extensionNumber < 0) {
            throw new NegativeExtensionNumberException(
                'Extension number (' . $extensionNumber . ') must not be negative number.'
            );
        }

        $newPhoneNumber = new self($this->countryCode(), $this->areaCode(), $this->phoneNumber());
        $newPhoneNumber->extensionNumber = $extensionNumber;
        return $newPhoneNumber;
    }

    /**
     * @param PhoneNumber $phoneNumber
     * @return bool
     */
    public function matches(PhoneNumber $phoneNumber): bool
    {
        if ($this->countryCode() !== $phoneNumber->countryCode()) {
            return false;
        }
        if ($this->areaCode() !== $phoneNumber->areaCode()) {
            return false;
        }
        if ($this->phoneNumber() !== $phoneNumber->phoneNumber()) {
            return false;
        }
        if ($this->extensionNumber() !== $phoneNumber->extensionNumber()) {
            return false;
        }

        return true;
    }

    /**
     * @param PhoneNumber $phoneNumber
     * @return bool
     */
    public function doesNotMatch(PhoneNumber $phoneNumber): bool
    {
        return !$this->matches($phoneNumber);
    }
}
