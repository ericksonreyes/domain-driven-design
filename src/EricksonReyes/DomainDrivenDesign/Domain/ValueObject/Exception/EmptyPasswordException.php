<?php

namespace EricksonReyes\DomainDrivenDesign\ValueObject\Exception;

use InvalidArgumentException;

final class EmptyPasswordException extends InvalidArgumentException
{
    public function __construct()
    {
        parent::__construct('Password is required.');
    }
}
