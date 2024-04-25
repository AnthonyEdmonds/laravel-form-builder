<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Traits;

use AnthonyEdmonds\LaravelFormBuilder\Bases\Container;
use AnthonyEdmonds\LaravelFormBuilder\Bases\Item;
use AnthonyEdmonds\LaravelFormBuilder\Exceptions\ItemNotFoundException;
use Illuminate\Database\Eloquent\Model;

/**
 * Seek and retrieve deeply nested Items
 * Designed to be run from a root class, such as Form
 * 
 * @property Model $model
 */
trait HasItems
{
    /**
     * A list of Items and Containers by class-string
     * Use values from the $model to perform Item branching
     * Fork Containers further allow you to compartmentalise logic
     *
     * @return class-string<Item|Container>[]
     */
    
    // TODO Switch to initialised version, it will be simpler.
    abstract public static function items(Model $model): array;
}
