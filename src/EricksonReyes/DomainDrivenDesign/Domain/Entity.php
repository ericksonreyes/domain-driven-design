<?php

namespace EricksonReyes\DomainDrivenDesign\Domain;

use EricksonReyes\DomainDrivenDesign\Common\ValueObject\Identifier;

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


    /**
     * @param Entity $anotherEntity
     * @return bool
     */
    public function matches(Entity $anotherEntity): bool;

    /**
     * @param Entity $anotherEntity
     * @return bool
     */
    public function doesNotMatch(Entity $anotherEntity): bool;
}
