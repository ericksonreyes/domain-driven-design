<?php


namespace EricksonReyes\EricksonReyes\DomainDrivenDesign\Common\ValueObject\Address;


use EricksonReyes\DomainDrivenDesign\Common\Abstracts\SizeableAndMatchableString;
use EricksonReyes\DomainDrivenDesign\Common\ValueObject\Person\Exception\EmptyNameException;

class ZipCode extends SizeableAndMatchableString
{


    /**
     * Name constructor.
     * @param string $zipCode
     */
    public function __construct(string $zipCode)
    {
        $trimmedZipCode = trim($zipCode);
        if ($trimmedZipCode === '') {
            throw new EmptyNameException('Zip code must not be empty.');
        }
        parent::__construct($trimmedZipCode);
    }
}