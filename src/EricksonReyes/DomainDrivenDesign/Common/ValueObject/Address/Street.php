<?php


namespace EricksonReyes\DomainDrivenDesign\Common\ValueObject\Address;

use EricksonReyes\DomainDrivenDesign\Common\Abstracts\SizeableAndMatchableString;
use EricksonReyes\DomainDrivenDesign\Common\ValueObject\Address\Exception\EmptyStreetError;

/**
 * Class Street
 * @package EricksonReyes\DomainDrivenDesign\Common\ValueObject\Address
 */
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
            throw new EmptyStreetError('Street must not be empty.');
        }
        parent::__construct($trimmedStreet);
    }
}
