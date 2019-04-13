<?php

namespace EricksonReyes\DomainDrivenDesign\Common\Attributes;

/**
 * Interface HasValue
 * @package EricksonReyes\DomainDrivenDesign\Common\Attributes
 */
interface HasValue
{
    /**
     * @return mixed
     */
    public function value();
}
