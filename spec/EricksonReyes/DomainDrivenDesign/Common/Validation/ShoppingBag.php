<?php
/**
 * Created by PhpStorm.
 * User: ericksonreyes
 * Date: 2019-03-08
 * Time: 16:53
 */

namespace spec\EricksonReyes\DomainDrivenDesign\Common\Validation;

use EricksonReyes\DomainDrivenDesign\Common\Interfaces\HasComposition;

class ShoppingBag implements HasComposition
{

    private $boughtItems;

    public function addItem($shoppingItem): void
    {
        $this->boughtItems[] = $shoppingItem;
    }


    /**
     * @return mixed
     */
    public function composition()
    {
        return $this->boughtItems;
    }
}
