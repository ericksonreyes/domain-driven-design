<?php

namespace EricksonReyes\DomainDrivenDesign\Example\Domain;

use EricksonReyes\DomainDrivenDesign\Domain\Entity;

/**
 * Class DomainEntity
 * @package EricksonReyes\DomainDrivenDesign\Example\Domain
 */
class DomainEntity implements Entity
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var bool
     */
    private $deleted = false;

    /**
     * DomainEntity constructor.
     * @param $id
     */
    public function __construct(string $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function id(): string
    {
        return $this->id;
    }

    /**
     * @return bool
     */
    public function isDeleted(): bool
    {
        return $this->deleted;
    }

    public function delete(): void
    {
        $this->deleted = true;
    }
}
