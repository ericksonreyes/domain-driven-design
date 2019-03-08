<?php

namespace EricksonReyes\DomainDrivenDesign\Domain;

use EricksonReyes\DomainDrivenDesign\Domain\ValueObject\Identifier;

/**
 * Interface Entity
 * @package EricksonReyes\DomainDrivenDesign\Domain
 */
interface Entity
{
    /**
     * @return Identifier
     */
    public function id(): Identifier;
}
