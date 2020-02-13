<?php

namespace EricksonReyes\DomainDrivenDesign\Common\ValueObject;

use EricksonReyes\DomainDrivenDesign\Common\Abstracts\SizeableAndMatchableString;
use EricksonReyes\EricksonReyes\DomainDrivenDesign\Common\ValueObject\Exception\MissingIdentifierException;

class Identifier extends SizeableAndMatchableString
{

    /**
     * Name constructor.
     * @param string $identifier
     */
    public function __construct(string $identifier)
    {
        $trimmedIdentifier = trim($identifier);
        if ($trimmedIdentifier === '') {
            throw new MissingIdentifierException('Identifier is required.');
        }
        parent::__construct($trimmedIdentifier);
    }
}
