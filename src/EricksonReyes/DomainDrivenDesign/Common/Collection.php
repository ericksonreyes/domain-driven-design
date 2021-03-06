<?php

namespace EricksonReyes\DomainDrivenDesign\Common;

use Countable;
use EricksonReyes\DomainDrivenDesign\Common\Interfaces\CanDetermineIfEmpty;
use Iterator;

/**
 * Class Collection
 * @package EricksonReyes\DomainDrivenDesign\Common
 */
abstract class Collection implements Iterator, Countable, CanDetermineIfEmpty
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

    public function rewind(): void
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
     * @return bool
     */
    public function isEmpty(): bool
    {
        return $this->count() === 0;
    }

    /**
     * @return bool
     */
    public function isNotEmpty(): bool
    {
        return !$this->isEmpty();
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
