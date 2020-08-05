<?php

namespace EricksonReyes\DomainDrivenDesign;

use EricksonReyes\DomainDrivenDesign\Domain\Entity;
use EricksonReyes\EricksonReyes\DomainDrivenDesign\Domain\EventSourcedEntityTrait;

/**
 * Class EventSourcedEntity
 * @package DomainDrivenDesign
 */
abstract class EventSourcedEntity implements Entity
{
    use EventSourcedEntityTrait;
}
