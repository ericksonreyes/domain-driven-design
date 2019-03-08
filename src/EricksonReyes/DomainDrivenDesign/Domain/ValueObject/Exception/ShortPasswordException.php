<?php

namespace EricksonReyes\DomainDrivenDesign\ValueObject\Exception;

use InvalidArgumentException;

final class ShortPasswordException extends InvalidArgumentException
{
    public function __construct()
    {
        parent::__construct('Your password is too short.');
    }
}
