<?php

namespace EricksonReyes\DomainDrivenDesign\Domain;

use EricksonReyes\DomainDrivenDesign\Common\Collection;

class History extends Collection
{
    /**
     * @param Event $domainEvent
     */
    public function recordThis(Event $domainEvent)
    {
        $this->addToCollection($domainEvent);
    }
}
