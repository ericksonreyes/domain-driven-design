<?php

namespace EricksonReyes\DomainDrivenDesign\Common\Exception;

use InvalidArgumentException;

/**
 * Class PermissionDeniedException
 * @package EricksonReyes\DomainDrivenDesign\Common\Exception
 */
abstract class PermissionDeniedError extends InvalidArgumentException
{
}
