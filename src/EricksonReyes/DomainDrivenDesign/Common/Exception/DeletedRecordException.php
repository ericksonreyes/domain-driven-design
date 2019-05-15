<?php

namespace EricksonReyes\DomainDrivenDesign\Common\Exception;

use InvalidArgumentException;

/**
 * Class DeletedRecordException
 * @package EricksonReyes\DomainDrivenDesign\Common\Exception
 */
abstract class DeletedRecordException extends InvalidArgumentException
{
}
