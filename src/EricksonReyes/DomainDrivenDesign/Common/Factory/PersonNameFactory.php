<?php

namespace EricksonReyes\DomainDrivenDesign\Common\Factory;

use EricksonReyes\DomainDrivenDesign\Common\Factory\Exception\MissingFirstNameException;
use EricksonReyes\DomainDrivenDesign\Common\Factory\Exception\MissingLastNameException;
use EricksonReyes\DomainDrivenDesign\Common\ValueObject\PersonName;

class PersonNameFactory
{
    /**
     * @param string $lastName
     * @param string $firstName
     * @param string|null $middleName
     * @param string|null $postNominal
     * @param string|null $honorific
     * @return PersonName
     */
    public static function create(
        string $lastName = '',
        string $firstName = '',
        ?string $middleName = '',
        ?string $postNominal = '',
        ?string $honorific = ''
    ): PersonName
    {
        if (self::hasLastName($lastName) === false) {
            throw new MissingLastNameException('Last name is required.');
        }

        if (self::hasFirstName($firstName) === false) {
            throw new MissingFirstNameException('First name is required.');
        }

        $personName = new PersonName($firstName, $lastName);

        if ($honorific !== null && trim($honorific) !== '') {
            $personName->withHonorific($honorific);
        }

        if ($middleName !== '' && trim($middleName) !== '') {
            $personName->withMiddleName($middleName);
        }

        if ($postNominal !== '' && trim($postNominal) !== '') {
            $personName->withPostNominals($postNominal);
        }

        return $personName;
    }

    /**
     * @param string|null $firstName
     * @return bool
     */
    private static function hasFirstName(string $firstName): bool
    {
        return trim($firstName) !== '';
    }

    /**
     * @param string|null $lastName
     * @return bool
     */
    private static function hasLastName(string $lastName): bool
    {
        return trim($lastName) !== '';
    }
}
