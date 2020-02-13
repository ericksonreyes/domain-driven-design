<?php


namespace EricksonReyes\EricksonReyes\DomainDrivenDesign\Common\ValueObject\Address;


use EricksonReyes\DomainDrivenDesign\Common\Abstracts\SizeableAndMatchableString;
use EricksonReyes\DomainDrivenDesign\Common\ValueObject\Person\Exception\EmptyNameException;
use EricksonReyes\EricksonReyes\DomainDrivenDesign\Common\ValueObject\Address\Exception\EmptyStreetException;

class Street extends SizeableAndMatchableString
{


    /**
     * Name constructor.
     * @param string $street
     */
    public function __construct(string $street)
    {
        $trimmedStreet = trim($street);
        if ($trimmedStreet === '') {
            throw new EmptyStreetException('Street must not be empty.');
        }
        parent::__construct($trimmedStreet);
    }
}