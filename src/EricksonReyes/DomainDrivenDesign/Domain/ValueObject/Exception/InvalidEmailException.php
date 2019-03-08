<?php

namespace EricksonReyes\DomainDrivenDesign\ValueObject\Exception;

use InvalidArgumentException;

final class InvalidEmailException extends InvalidArgumentException
{
    public function __construct()
    {
        parent::__construct('Invalid e-mail address.');
    }
}
