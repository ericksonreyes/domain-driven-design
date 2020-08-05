<?php


namespace EricksonReyes\DomainDrivenDesign\Common\ValueObject\Address;

/**
 * Class Address
 * @package EricksonReyes\DomainDrivenDesign\Common\ValueObject\Address
 */
class Address
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
     * Address constructor.
     * @param Street $street
     * @param City $city
     * @param State $state
     * @param CountryCode $countryCode
     * @param ZipCode $zipCode
     */
    public function __construct(Street $street, City $city, State $state, CountryCode $countryCode, ZipCode $zipCode)
    {
        $this->street = $street;
        $this->city = $city;
        $this->state = $state;
        $this->countryCode = $countryCode;
        $this->zipCode = $zipCode;
    }

    /**
     * @return Street
     */
    public function street(): Street
    {
        return $this->street;
    }

    /**
     * @return City
     */
    public function city(): City
    {
        return $this->city;
    }

    /**
     * @return State
     */
    public function state(): State
    {
        return $this->state;
    }

    /**
     * @return CountryCode
     */
    public function countryCode(): CountryCode
    {
        return $this->countryCode;
    }

    /**
     * @return ZipCode
     */
    public function zipCode(): ZipCode
    {
        return $this->zipCode;
    }

    /**
     * @param Address $anotherAddress
     * @return bool
     */
    public function matches(Address $anotherAddress): bool
    {
        if ($this->street() !== $anotherAddress->street()) {
            return false;
        }

        if ($this->city() !== $anotherAddress->city()) {
            return false;
        }

        if ($this->state() !== $anotherAddress->state()) {
            return false;
        }

        if ($this->countryCode() !== $anotherAddress->countryCode()) {
            return false;
        }

        if ($this->zipCode() !== $anotherAddress->zipCode()) {
            return false;
        }
        return true;
    }
}
