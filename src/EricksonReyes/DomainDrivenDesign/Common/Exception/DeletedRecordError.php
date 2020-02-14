<?php

namespace EricksonReyes\DomainDrivenDesign\Common\Exception;

use InvalidArgumentException;

/**
 * Class DeletedRecordException
 * @package EricksonReyes\DomainDrivenDesign\Common\Exception
 */
abstract class DeletedRecordError extends InvalidArgumentException
{
}
