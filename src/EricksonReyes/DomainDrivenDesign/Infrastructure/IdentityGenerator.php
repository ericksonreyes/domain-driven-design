<?php

namespace EricksonReyes\DomainDrivenDesign\Infrastructure;

use EricksonReyes\DomainDrivenDesign\Domain\ValueObject\Identifier;

/**
 * Interface IdentityGenerator
 * @package EricksonReyes\DomainDrivenDesign\Infrastructure
 */
interface IdentityGenerator
{
    /**
     * @param string $prefix
     * @return Identifier
     */
    public function nextIdentity($prefix = ''): Identifier;
}
