<?php

namespace EricksonReyes\DomainDrivenDesign\Common\Attributes;

/**
 * Interface Arrayable
 * @package EricksonReyes\DomainDrivenDesign\Common\Attributes
 */
interface Arrayable
{
    /**
     * @return array
     */
    public function toArray(): array;
}
