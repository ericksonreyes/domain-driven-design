<?php

namespace EricksonReyes\DomainDrivenDesign\Domain;

/**
 * Interface Repository
 * @package EricksonReyes\DomainDrivenDesign\Domain
 */
interface Repository
{
    /**
     * @param string $entityId
     * @return Entity|null
     */
    public function findById(string $entityId): ?Entity;

    /**
     * @param Entity $entity
     */
    public function store(Entity $entity): void;
}
