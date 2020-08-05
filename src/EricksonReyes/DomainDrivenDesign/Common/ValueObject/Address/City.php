<?php


namespace EricksonReyes\DomainDrivenDesign\Common\ValueObject\Address;

use EricksonReyes\DomainDrivenDesign\Common\Abstracts\SizeableAndMatchableString;
use EricksonReyes\DomainDrivenDesign\Common\ValueObject\Address\Exception\EmptyCityError;

/**
 * Class City
 * @package EricksonReyes\DomainDrivenDesign\Common\ValueObject\Address
 */
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
            throw new EmptyCityError('City must not be empty.');
        }
        parent::__construct($trimmedCity);
    }
}
