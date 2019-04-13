<?php

namespace EricksonReyes\DomainDrivenDesign\Common\ValueObject;

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

/**
 * Class PhoneNumber
 * @package EricksonReyes\DomainDrivenDesign\Common\ValueObject
 *
 * @SuppressWarnings(PHPMD.UnusedPrivateMethod)
 */
class PhoneNumber implements ValueObject
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
     * @param int $phoneNumber
     */
    public function __construct(int $phoneNumber)
    {
        $exceptionMessage = $phoneNumber . ' is not a valid phone number.';

        if ($phoneNumber === 0) {
            throw new ZeroPhoneNumberException($exceptionMessage);
        }
        if ($phoneNumber < 0) {
            throw new NegativePhoneNumberException($exceptionMessage);
        }
        if ($phoneNumber < 1000) {
            throw new ShortPhoneNumberException($exceptionMessage);
        }
        if ($phoneNumber > 9999999) {
            throw new LongPhoneNumberException($exceptionMessage);
        }

        $this->phoneNumber = $phoneNumber;
    }

    public static function createWithCountryAndAreaCode(int $countryCode, int $areaCode, int $phoneNumber): self
    {
        $phoneNumber = new self($phoneNumber);
        $phoneNumber->setCountryCode($countryCode);
        $phoneNumber->setAreaCode($areaCode);

        return $phoneNumber;
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
    public function countryCode(): ?int
    {
        return $this->countryCode;
    }

    /**
     * @return int|null
     */
    public function areaCode(): ?int
    {
        return $this->areaCode;
    }

    /**
     * @param PhoneNumber $anotherPhoneNumber
     * @return bool
     */
    public function matches(PhoneNumber $anotherPhoneNumber): bool
    {
        $fields = ['phoneNumber', 'areaCode', 'countryCode', 'extensionNumber'];

        foreach ($fields as $field) {
            if ($anotherPhoneNumber->$field() !== $this->$field()) {
                return false;
            }
        }

        return true;
    }

    /**
     * @param int $extensionNumber
     * @return PhoneNumber
     */
    public function withExtensionNumber(int $extensionNumber): self
    {
        $this->setExtensionNumber($extensionNumber);
        return $this->init();
    }

    /**
     * @return int|null
     */
    public function extensionNumber(): ?int
    {
        return $this->extensionNumber;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'countryCode' => $this->countryCode,
            'areaCode' => $this->areaCode,
            'phoneNumber' => $this->phoneNumber,
            'extensionNumber' => $this->extensionNumber
        ];
    }

    /**
     * @param PhoneNumber $anotherPhoneNumber
     * @return bool
     */
    public function doesNotMatch(PhoneNumber $anotherPhoneNumber): bool
    {
        return !$this->matches($anotherPhoneNumber);
    }

    /**
     * @param $countryCode
     */
    private function setCountryCode($countryCode): void
    {
        $exceptionMessage = $countryCode . ' is not a valid country code.';

        if ($countryCode === 0) {
            throw new ZeroCountryCodeException($exceptionMessage);
        }
        if ($countryCode < 0) {
            throw new NegativeCountryCodeException($exceptionMessage);
        }

        $this->countryCode = $countryCode;
    }

    /**
     * @param $areaCode
     */
    private function setAreaCode($areaCode): void
    {
        $exceptionMessage = $areaCode . ' is not a valid area code.';

        if ($areaCode === 0) {
            throw new ZeroAreaCodeException($exceptionMessage);
        }
        if ($areaCode < 0) {
            throw new NegativeAreaCodeException($exceptionMessage);
        }

        $this->areaCode = $areaCode;
    }

    /**
     * @param $extensionNumber
     */
    private function setExtensionNumber($extensionNumber): void
    {
        $exceptionMessage = $extensionNumber . ' is not a valid extension number.';

        if ($extensionNumber < 0) {
            throw new NegativeExtensionNumberException($exceptionMessage);
        }

        $this->extensionNumber = $extensionNumber;
    }

    /**
     * @return PhoneNumber
     */
    private function init(): self
    {
        $anotherName = new self($this->phoneNumber);

        $optionalFields = ['areaCode', 'countryCode', 'extensionNumber'];
        foreach ($optionalFields as $optionalField) {
            if ($this->$optionalField !== null) {
                $anotherName->$optionalField = $this->$optionalField;
            }
        }

        return $anotherName;
    }
}
