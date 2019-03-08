<?php

namespace EricksonReyes\DomainDrivenDesign\ValueObject\Exception;

use InvalidArgumentException;

class WeakPasswordException extends InvalidArgumentException
{
    public function __construct($message = 'Password provided is weak.')
    {
        parent::__construct($message);
    }
}
