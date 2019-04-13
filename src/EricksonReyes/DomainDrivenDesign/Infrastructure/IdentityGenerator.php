<?php

namespace EricksonReyes\DomainDrivenDesign\Infrastructure;

/**
 * Interface IdentityGenerator
 * @package EricksonReyes\DomainDrivenDesign\Infrastructure
 */
interface IdentityGenerator
{
    /**
     * @param string $prefix
     * @return string
     */
    public function nextIdentity($prefix = ''): string;
}
