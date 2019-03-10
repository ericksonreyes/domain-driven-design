<?php

namespace EricksonReyes\DomainDrivenDesign\Domain;

use EricksonReyes\DomainDrivenDesign\Common\Collection;

/**
 * Class History
 * @package EricksonReyes\DomainDrivenDesign\Domain
 */
class History extends Collection
{
    /**
     * @param Event $event
     */
    public function recordThis(Event $event): void
    {
        $this->addToCollection($event);
    }
}
