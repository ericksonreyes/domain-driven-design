<?php

namespace EricksonReyes\DomainDrivenDesign\Example\Domain;

use DateTimeImmutable;
use EricksonReyes\DomainDrivenDesign\Common\ValueObject\Identifier;
use EricksonReyes\EricksonReyes\DomainDrivenDesign\Domain\FileAttachingEntityTrait;

class FileAttachingDomainEntity extends DomainEntity
{
    use FileAttachingEntityTrait;

    /**
     * @var Identifier
     */
    private $id;

    /**
     * @var string
     */
    private $additionalData = '';

    /**
     * @var bool
     */
    private $deleted = false;

    /**
     * @var DateTimeImmutable
     */
    private $deletedOn;

}
