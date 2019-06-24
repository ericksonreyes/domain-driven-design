<?php

namespace EricksonReyes\DomainDrivenDesign\Common\Factory;

use EricksonReyes\DomainDrivenDesign\Common\ValueObject\Address;

/**
 * Class AddressFactory
 * @package EricksonReyes\DomainDrivenDesign\Common\Factory
 */
class AddressFactory
{
    /**
     * @param string $street
     * @param string $city
     * @param string $state
     * @param string $countryIso2Code
     * @param string $zipCode
     * @return Address
     */
    public static function create(
        string $street,
        string $city,
        string $state,
        string $countryIso2Code,
        string $zipCode
    ): Address
    {
        $country = CountryFactory::create($countryIso2Code);
        return new Address(
            trim($street),
            trim($city),
            trim($state),
            $country,
            trim($zipCode)
        );
    }
}
