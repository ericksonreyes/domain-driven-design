<?php

namespace EricksonReyes\DomainDrivenDesign\Common\Factory;

use EricksonReyes\DomainDrivenDesign\Common\ValueObject\PhoneNumber;

class PhoneFactory
{

    /**
     * @param int $phoneNumber
     * @param int|null $countryIso2Code
     * @param int|null $areaCode
     * @return PhoneNumber
     */
    public static function create(int $phoneNumber, ?int $countryIso2Code = 0, ?int $areaCode = 0): PhoneNumber
    {
        if (
            self::hasCountryIso2Code($countryIso2Code) &&
            self::hasAreaCode($areaCode)
        ) {
            return PhoneNumber::createWithCountryAndAreaCode(
                $countryIso2Code,
                $areaCode ?? 0,
                $phoneNumber
            );
        }
        return new PhoneNumber($phoneNumber);
    }

    /**
     * @param int|null $countryIso2Code
     * @return bool
     */
    private static function hasCountryIso2Code(?int $countryIso2Code): bool
    {
        return $countryIso2Code !== null && $countryIso2Code > 0;
    }

    /**
     * @param int|null $areaCode
     * @return bool
     */
    private static function hasAreaCode(?int $areaCode): bool
    {
        return ($areaCode !== null && $areaCode > 0);
    }
}
