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
    public function create(int $phoneNumber, ?int $countryIso2Code = 0, ?int $areaCode = 0): PhoneNumber
    {
        if (
            $countryIso2Code !== null && $countryIso2Code > 0 &&
            $areaCode !== null && $areaCode > 0
        ) {
            return PhoneNumber::createWithCountryAndAreaCode(
                $countryIso2Code,
                $areaCode ?? 0,
                $phoneNumber
            );
        }
        return new PhoneNumber($phoneNumber);
    }
}
