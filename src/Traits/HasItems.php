<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Traits;

use AnthonyEdmonds\LaravelFormBuilder\Bases\Container;
use AnthonyEdmonds\LaravelFormBuilder\Bases\Form;
use AnthonyEdmonds\LaravelFormBuilder\Bases\Item;
use AnthonyEdmonds\LaravelFormBuilder\Exceptions\ItemNotFoundException;
use AnthonyEdmonds\LaravelFormBuilder\Items\Fork;
use Illuminate\Database\Eloquent\Model;

/**
 * Seek and retrieve deeply nested Items
 * Designed to be run from a root class, such as Form
 *
 * @property Model $model
 * @property Form|Item|Container $parent
 */
trait HasItems
{
    /** @var class-string<Item|Container>[] A list of Items and Containers by class-string */
    protected array $items = [];

    /** @var Item[]|Container[] Instantiated Items and Containers */
    protected array $children = [];

    /** @return Item|Container|null Get the first Item, or null */
    public function getFirstItem(): Item|Container|null
    {
        if ($this->hasItems() === false) {
            return null;
        }

        $firstKey = array_key_first($this->children);
        $item = $this->children[$firstKey];

        return is_a($item, Fork::class) === true
            ? $item->getFirstItem()
            : $item;
    }

    /** @return Item|Container Get an Item which is a direct child */
    public function getItem(string $key): Item|Container
    {
        if (array_key_exists($key, $this->children) !== true) {
            throw new ItemNotFoundException($key);
        }

        return $this->children[$key];
    }

    /** @return Item|Container Get an Item which is deeply nested at a given path of keys */
    public function getItemAt(array $path): Item|Container
    {
        $key = array_shift($path);
        $item = $this->getItem($key);

        return count($path) > 0
            ? $item->getItemAt($path)
            : $item;
    }

    /** @return Item|Container|null Get the first Item, or null */
    public function getLastItem(): Item|Container|null
    {
        if ($this->hasItems() === false) {
            return null;
        }

        // TODO Handle fork
        $lastKey = array_key_last($this->children);

        return $this->children[$lastKey];
    }

    /** @return Item|Container|null Get the next Item in sequence */
    public function getNextItem(Item $item): Item|Container|null
    {
        if (array_key_last($this->children) === $item::KEY) {
            if (is_a($this, Form::class) === true) {
                return null;
            }

            $nextItem = $this->parent->getNextItem($this);
        } else {
            $index = array_search($item::class, $this->items) + 1;
            $nextItem = $this->getItem($this->items[$index]::KEY);
        }

        /** Fork needs to handle coming back down when no items on branch */
        return is_a($nextItem, Fork::class) === true
            ? $nextItem->getFirstItem()
            : $nextItem;
    }

    /** @return bool Whether there are any Items */
    public function hasItems(): bool
    {
        return empty($this->children) === false;
    }

    /** Create instances of all Items */
    protected function populateItems(): void
    {
        foreach ($this->items as $item) {
            $item = new $item($this->model, $this);
            $this->children[$item::KEY] = $item;
        }
    }
}
