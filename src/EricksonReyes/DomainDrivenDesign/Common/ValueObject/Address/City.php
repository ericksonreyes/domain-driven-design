<?php


namespace EricksonReyes\EricksonReyes\DomainDrivenDesign\Common\ValueObject\Address;


use EricksonReyes\DomainDrivenDesign\Common\Abstracts\SizeableAndMatchableString;
use EricksonReyes\EricksonReyes\DomainDrivenDesign\Common\ValueObject\Address\Exception\EmptyCityException;

class City extends SizeableAndMatchableString
{


    /**
     * Name constructor.
     * @param string $city
     */
    public function __construct(string $city)
    {
        $trimmedCity = trim($city);
        if ($trimmedCity === '') {
            throw new EmptyCityException('City must not be empty.');
        }
        parent::__construct($trimmedCity);
    }
}