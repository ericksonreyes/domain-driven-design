<?php

namespace EricksonReyes\DomainDrivenDesign\Application\Exception;

use EricksonReyes\DomainDrivenDesign\Common\Exception\UnauthenticatedUserException;

/**
 * Class LoginFailedException
 * @package EricksonReyes\DomainDrivenDesign\Application\Exception
 */
final class LoginFailedException extends UnauthenticatedUserException
{
}
