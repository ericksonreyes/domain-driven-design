<?php

namespace EricksonReyes\DomainDrivenDesign\Common\ValueObject\Person;

use EricksonReyes\DomainDrivenDesign\Common\Abstracts\SizeableAndMatchableString;
use EricksonReyes\DomainDrivenDesign\Common\ValueObject\Person\Exception\EmptyNameError;

/**
 * Class Name
 * @package EricksonReyes\DomainDrivenDesign\Common\ValueObject\Person
 */
class Name extends SizeableAndMatchableString
{

    /**
     * Name constructor.
     * @param string $identifier
     */
    public function __construct(string $identifier)
    {
        $trimmedName = trim($identifier);
        if ($trimmedName === '') {
            throw new EmptyNameError('Name must not be empty.');
        }
        parent::__construct($trimmedName);
    }
}
