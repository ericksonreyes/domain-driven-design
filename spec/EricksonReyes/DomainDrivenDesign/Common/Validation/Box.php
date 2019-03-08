<?php

namespace spec\EricksonReyes\DomainDrivenDesign\Common\Validation;

use EricksonReyes\DomainDrivenDesign\Common\HasComposition;

class Box implements HasComposition
{


    private $item;

    public function insertItem($item): void
    {
        $this->item = $item;
    }

    /**
     * @return mixed
     */
    public function getComposition()
    {
        return $this->item;
    }
}