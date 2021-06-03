<?php


namespace EricksonReyes\DomainDrivenDesign\Domain;

use EricksonReyes\DomainDrivenDesign\Domain\Entity;

/**
 * Class FileAttachingEntity
 * @package EricksonReyes\EricksonReyes\DomainDrivenDesign\Domain
 */
abstract class FileAttachingEntity implements Entity
{
    use FileAttachingEntityTrait;
}
