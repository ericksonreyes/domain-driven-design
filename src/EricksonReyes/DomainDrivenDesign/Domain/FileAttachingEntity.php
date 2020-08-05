<?php


namespace EricksonReyes\EricksonReyes\DomainDrivenDesign\Domain;


use EricksonReyes\DomainDrivenDesign\Domain\Entity;

abstract class FileAttachingEntity implements Entity
{
    use FileAttachingEntityTrait;
}