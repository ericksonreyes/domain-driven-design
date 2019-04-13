<?php

namespace EricksonReyes\DomainDrivenDesign\Common\ValueObject;

use EricksonReyes\DomainDrivenDesign\Common\Attributes\ValueObject;

/**
 * Class Address
 * @package EricksonReyes\DomainDrivenDesign\Common\ValueObject
 */
class Address implements ValueObject
{
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
     * @var Country
     */
    private $country;

    /**
     * @var string
     */
    private $zipCode;

    /**
     * Address constructor.
     * @param string $street
     * @param string $city
     * @param string $state
     * @param Country $country
     * @param string $zipCode
     */
    public function __construct(string $street, string $city, string $state, Country $country, string $zipCode)
    {
        $this->street = $street;
        $this->city = $city;
        $this->state = $state;
        $this->country = $country;
        $this->zipCode = $zipCode;
    }

    /**
     * @return string
     */
    public function street(): string
    {
        return $this->street;
    }

    /**
     * @return string
     */
    public function city(): string
    {
        return $this->city;
    }

    /**
     * @return string
     */
    public function state(): string
    {
        return $this->state;
    }

    /**
     * @return Country
     */
    public function country(): Country
    {
        return $this->country;
    }

    /**
     * @return string
     */
    public function zipCode(): string
    {
        return $this->zipCode;
    }


    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'street' => $this->street(),
            'city' => $this->city(),
            'state' => $this->state(),
            'country' => $this->country()->toArray(),
            'zipCode' => $this->zipCode()
        ];
    }

    /**
     * @param Address $anotherAddress
     * @return bool
     */
    public function matches(Address $anotherAddress): bool
    {
        $fields = ['street', 'city', 'state', 'zipCode'];

        foreach ($fields as $field) {
            if ($anotherAddress->$field() !== $this->$field()) {
                return false;
            }
        }

        return $this->country()->matches($anotherAddress->country());
    }

    /**
     * @param Address $anotherAddress
     * @return bool
     */
    public function doesNotMatch(Address $anotherAddress): bool
    {
        return !$this->matches($anotherAddress);
    }
}
