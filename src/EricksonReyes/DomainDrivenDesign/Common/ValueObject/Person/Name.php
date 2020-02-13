<?php

namespace EricksonReyes\DomainDrivenDesign\Common\ValueObject\Person;

use EricksonReyes\DomainDrivenDesign\Common\Abstracts\SizeableAndMatchableString;
use EricksonReyes\DomainDrivenDesign\Common\ValueObject\Person\Exception\MissingNameException;

/**
 * Class Name
 * @package EricksonReyes\DomainDrivenDesign\Common\ValueObject\Person
 */
class Name extends SizeableAndMatchableString
{

    /**
     * Name constructor.
     * @param string $name
     */
    public function __construct(string $name)
    {
        $trimmedName = trim($name);
        if ($trimmedName === '') {
            throw new MissingNameException('Name is required.');
        }
        parent::__construct($trimmedName);
    }
}
