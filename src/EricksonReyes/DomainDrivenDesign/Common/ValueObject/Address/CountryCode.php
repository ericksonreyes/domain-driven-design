<?php


namespace EricksonReyes\DomainDrivenDesign\Common\ValueObject\Address;

use EricksonReyes\DomainDrivenDesign\Common\Abstracts\SizeableAndMatchableString;
use EricksonReyes\DomainDrivenDesign\Common\ValueObject\Address\Exception\EmptyCountryCodeError;

/**
 * Class CountryCode
 * @package EricksonReyes\DomainDrivenDesign\Common\ValueObject\Address
 */
class CountryCode extends SizeableAndMatchableString
{


    /**
     * Name constructor.
     * @param string $countryCode
     */
    public function __construct(string $countryCode)
    {
        $trimmedCountryCode = trim($countryCode);
        if ($trimmedCountryCode === '') {
            throw new EmptyCountryCodeError('Country code must not be empty.');
        }
        parent::__construct($trimmedCountryCode);
    }
}
