<?php

namespace EricksonReyes\DomainDrivenDesign\Domain;


/**
 * Class EventSourcedEntity
 * @package DomainDrivenDesign
 */
abstract class EventSourcedEntity implements Entity
{
    use EventSourcedEntityTrait;
}
