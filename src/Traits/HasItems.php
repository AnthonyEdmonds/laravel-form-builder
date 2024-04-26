<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Traits;

use AnthonyEdmonds\LaravelFormBuilder\Bases\Container;
use AnthonyEdmonds\LaravelFormBuilder\Bases\Form;
use AnthonyEdmonds\LaravelFormBuilder\Bases\Item;
use AnthonyEdmonds\LaravelFormBuilder\Exceptions\ItemNotFoundException;
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
    /**
     * A list of Items and Containers by class-string
     *
     * @var class-string<Item|Container>[]
     */
    protected array $items = [];

    /**
     * Instantiated Items and Containers
     *
     * @var Item[]|Container[]
     */
    protected array $children = [];

    /** Get an Item which is a direct child */
    public function item(string $key): Item|Container
    {
        if (array_key_exists($key, $this->children) !== true) {
            throw new ItemNotFoundException($key);
        }

        return $this->children[$key];
    }

    /**
     * Get an Item which is deeply nested at a given path of keys
     * ['my-form', 'my-fork', 'my-question']
     */
    public function itemAt(array $path): Item|Container
    {
        $key = array_shift($path);
        $item = $this->item($key);

        return count($path) > 0
            ? $item->itemAt($path)
            : $item;
    }

    /** Create instances of all Items */
    protected function populate(): void
    {
        foreach ($this->items as $item) {
            $item = new $item($this->model, $this);
            $this->children[$item->key] = $item;
        }
    }
}
