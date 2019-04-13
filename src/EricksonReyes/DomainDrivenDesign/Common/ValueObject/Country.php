<?php

namespace EricksonReyes\DomainDrivenDesign\Common\ValueObject;

use EricksonReyes\DomainDrivenDesign\Common\Attributes\ValueObject;
use EricksonReyes\DomainDrivenDesign\Common\ValueObject\Exception\InvalidCountryISO2CodeException;
use EricksonReyes\DomainDrivenDesign\Common\ValueObject\Exception\InvalidCountryISO3CodeException;
use EricksonReyes\DomainDrivenDesign\Common\ValueObject\Exception\InvalidCountryNameException;

/**
 * Class Country
 * @package EricksonReyes\DomainDrivenDesign\Common\ValueObject
 */
class Country implements ValueObject
{

    /**
     * @var string
     */
    private $iso2Code;

    /**
     * @var string
     */
    private $iso3Code;

    /**
     * @var string
     */
    private $name;

    /**
     * Country constructor.
     * @param string $iso2Code
     * @param string $iso3Code
     * @param string $name
     */
    public function __construct(string $iso2Code, string $iso3Code, string $name)
    {
        if ($this->isInvalidCountryIsoCode($iso2Code, 2)) {
            throw new InvalidCountryISO2CodeException(
                'ISO alpha-2 country code must consist of 2 capital letters only.'
            );
        }

        if ($this->isInvalidCountryIsoCode($iso3Code, 3)) {
            throw new InvalidCountryISO3CodeException(
                'ISO alpha-3 country code must consist of 3 capital letters only.'
            );
        }

        if ($this->isAnInvalidCountryName($name)) {
            throw new InvalidCountryNameException('Country name must not be empty.');
        }

        $this->iso2Code = $iso2Code;
        $this->iso3Code = $iso3Code;
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function iso2Code(): string
    {
        return $this->iso2Code;
    }

    /**
     * @return string
     */
    public function iso3Code(): string
    {
        return $this->iso3Code;
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'iso2Code' => $this->iso2Code(),
            'iso3Code' => $this->iso3Code(),
            'name' => $this->name()
        ];
    }

    /**
     * @param Country $anotherCountry
     * @return bool
     */
    public function matches(Country $anotherCountry): bool
    {
        $fields = ['iso2Code', 'iso3Code', 'name'];

        foreach ($fields as $field) {
            if ($anotherCountry->$field() !== $this->$field()) {
                return false;
            }
        }

        return true;
    }

    /**
     * @param Country $anotherCountry
     * @return bool
     */
    public function doesNotMatch(Country $anotherCountry): bool
    {
        return !$this->matches($anotherCountry);
    }

    /**
     * @param string $name
     * @return bool
     */
    protected function isAnInvalidCountryName(string $name): bool
    {
        return trim($name) === '';
    }

    /**
     * @param string $isoCode
     * @param int $lengthLimit
     * @return bool
     */
    private function isInvalidCountryIsoCode(string $isoCode, int $lengthLimit): bool
    {
        return strlen($isoCode) !== $lengthLimit || !preg_match("/[A-Z]{{$lengthLimit}}/", $isoCode);
    }
}
