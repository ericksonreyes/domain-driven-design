<?php

namespace EricksonReyes\DomainDrivenDesign;

/**
 * Interface IdentityGenerator
 * @package EricksonReyes\DomainDrivenDesign
 */
interface IdentityGenerator
{
    /**
     * @param string $prefix
     * @return string
     */
    public function nextIdentity($prefix = ''): string;
}
