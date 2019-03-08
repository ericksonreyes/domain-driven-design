<?php
/**
 * Created by PhpStorm.
 * User: ericksonreyes
 * Date: 2019-03-08
 * Time: 18:18
 */

namespace EricksonReyes\DomainDrivenDesign\Common\Exception;

use InvalidArgumentException;


abstract class RecordNotFoundException extends InvalidArgumentException
{
}