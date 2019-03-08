<?php

namespace EricksonReyes\DomainDrivenDesign\Domain;

use EricksonReyes\DomainDrivenDesign\Domain\ValueObject\Identifier;

interface Entity
{
    /**
     * @return Identifier
     */
    public function id(): Identifier;
}
