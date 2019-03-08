<?php
namespace EricksonReyes\DomainDrivenDesign\ValueObject\Exception;

use Exception;

final class EmptyEmailException extends Exception
{
    public function __construct()
    {
        parent::__construct('E-mail address is required.');
    }
}
