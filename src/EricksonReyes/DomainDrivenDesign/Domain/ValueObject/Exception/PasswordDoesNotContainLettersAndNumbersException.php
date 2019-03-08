<?php

namespace EricksonReyes\DomainDrivenDesign\ValueObject\Exception;

final class PasswordDoesNotContainLettersAndNumbersException extends WeakPasswordException
{
    public function __construct($message = 'Password must have at least a letter and a number.')
    {
        parent::__construct($message);
    }
}
