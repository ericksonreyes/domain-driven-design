<?php

namespace EricksonReyes\DomainDrivenDesign\Common\Exception;

use InvalidArgumentException;

/**
 * Class RecordNotFoundException
 * @package EricksonReyes\DomainDrivenDesign\Common\Exception
 */
abstract class RecordNotFoundError extends InvalidArgumentException
{
}
