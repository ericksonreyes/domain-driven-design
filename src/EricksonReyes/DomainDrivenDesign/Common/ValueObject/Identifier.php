<?php

namespace EricksonReyes\DomainDrivenDesign\Common\ValueObject;

use EricksonReyes\DomainDrivenDesign\Common\Abstracts\SizeableAndMatchableString;
use EricksonReyes\DomainDrivenDesign\Common\ValueObject\Exception\EmptyIdentifierException;

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
            throw new EmptyIdentifierException('Identifier must not be empty.');
        }
        parent::__construct($trimmedIdentifier);
    }
}
