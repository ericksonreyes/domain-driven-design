<?php

namespace EricksonReyes\DomainDrivenDesign\Example;

use EricksonReyes\DomainDrivenDesign\Domain\Entity;
use EricksonReyes\DomainDrivenDesign\Domain\ValueObject\Identifier;

class DomainEntity implements Entity
{
    /**
     * @var Identifier
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
    public function __construct(Identifier $id)
    {
        $this->id = $id;
    }

    /**
     * @return Identifier
     */
    public function id(): Identifier
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
