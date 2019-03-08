<?php

namespace EricksonReyes\DomainDrivenDesign\Common;

use Countable;
use Iterator;

/**
 * Class Collection
 * @package EricksonReyes\DomainDrivenDesign\Common
 */
abstract class Collection implements Iterator, Countable
{
    /**
     * @var int
     */
    private $position;

    /**
     * @var int
     */
    private $count;

    /**
     * @var array
     */
    private $items = [];

    public function __construct()
    {
        $this->position = 0;
        $this->count = 0;
    }

    public function rewind(): int
    {
        $this->position = 0;
    }

    /**
     * @return mixed
     */
    public function current()
    {
        return $this->items[$this->position];
    }

    /**
     * @return int|mixed
     */
    public function key(): int
    {
        return $this->position;
    }

    public function next(): void
    {
        ++$this->position;
    }

    /**
     * @return bool
     */
    public function valid(): bool
    {
        return isset($this->items[$this->position]);
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return $this->count;
    }

    /**
     * @param $item
     */
    protected function addToCollection($item): void
    {
        $this->items[] = $item;
        $this->count++;
    }
}
