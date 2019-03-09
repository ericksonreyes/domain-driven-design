<?php

namespace EricksonReyes\DomainDrivenDesign\Application\Exception;

use EricksonReyes\DomainDrivenDesign\Common\Exception\UnauthenticatedUserException;

final class LoginFailedException extends UnauthenticatedUserException
{
}
