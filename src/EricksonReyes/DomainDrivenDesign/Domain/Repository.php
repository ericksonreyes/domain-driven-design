<?php

namespace EricksonReyes\DomainDrivenDesign\Domain;

use EricksonReyes\DomainDrivenDesign\Domain\ValueObject\Identifier;

/**
 * Interface Repository
 * @package EricksonReyes\DomainDrivenDesign\Domain
 */
interface Repository
{
    /**
     * @param Identifier $entityId
     * @return Entity|null
     */
    public function findById(Identifier $entityId): ?Entity;

    /**
     * @param Entity $entity
     */
    public function store(Entity $entity): void;
}
