<?php

namespace EricksonReyes\DomainDrivenDesign\Example\Domain;

use EricksonReyes\DomainDrivenDesign\Common\ValueObject\Identifier;
use EricksonReyes\DomainDrivenDesign\Domain\Entity;

/**
 * Class DomainEntity
 * @package EricksonReyes\DomainDrivenDesign\Example\Domain
 */
class DomainEntity implements Entity
{
    /**
     * @var Identifier
     */
    private $id;

    /**
     * DomainEntity constructor.
     * @param Identifier $id
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
     * @param Entity $anotherEntity
     * @return bool
     */
    public function matches(Entity $anotherEntity): bool
    {
        return $this->id()->matches($anotherEntity->id());
    }

    /**
     * @param Entity $anotherEntity
     * @return bool
     */
    public function doesNotMatch(Entity $anotherEntity): bool
    {
        return !$this->matches($anotherEntity);
    }
}
