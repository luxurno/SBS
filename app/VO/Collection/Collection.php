<?php

declare(strict_types = 1);

namespace App\VO\Collection;

use App\VO\AbstractVOModel;
use Countable;

abstract class Collection implements Countable
{
    /** @var array[] AbstractVOModel */
    private array $items = [];

    public function count(): int
    {
        return count($this->items);
    }

    public function add(AbstractVOModel $model): void
    {
        $key = spl_object_hash($model);

        $this->items[$key] = $model;
    }

    public function getAll(): array
    {
        return $this->items;
    }

    public function toArray(): array
    {
        $items = [];
        foreach ($this->getAll() as $key => $item) {
            /** @var AbstractVOModel $item */
            $items[] = $item->toArray();
        }

        return $items;
    }
}
