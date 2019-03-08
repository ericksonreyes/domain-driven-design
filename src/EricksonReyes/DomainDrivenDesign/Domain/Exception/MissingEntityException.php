<?php

namespace EricksonReyes\DomainDrivenDesign\Domain\Exception;

use EricksonReyes\DomainDrivenDesign\Common\Exception\DeletedRecordException;

abstract class MissingEntityException extends DeletedRecordException
{
}
