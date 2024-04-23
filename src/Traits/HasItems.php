<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Traits;

use AnthonyEdmonds\LaravelFormBuilder\Bases\Container;
use AnthonyEdmonds\LaravelFormBuilder\Bases\Item;
use AnthonyEdmonds\LaravelFormBuilder\Exceptions\ItemNotFoundException;
use Illuminate\Database\Eloquent\Model;

trait HasItems
{
    /**
     * A list of Items and Containers by class-string
     * Use values from the $model to perform Item branching
     * Fork Containers further allow you to compartmentalise logic
     *
     * @return class-string<Item|Container>[]
     */
    abstract public static function items(Model $model): array;

    /** Does this Container have an Item as a descendant? */
    public static function childHasItem(string $key, Model $model): bool
    {
        $items = static::items($model);

        foreach ($items as $item) {
            if (is_a($item, Container::class, true) === false) {
                continue;
            }

            if ($item::containsItem($key, $model) === true) {
                return true;
            }
        }

        return false;
    }

    /** Does this Container have an Item as a child or descendant? */
    public static function containsItem(string $key, Model $model): bool
    {
        if (static::hasItem($key, $model) === true) {
            return true;
        }

        return static::childHasItem($key, $model) === true;
    }

    /** Does this Container have an Item as a child? */
    public static function hasItem(string $key, Model $model): bool
    {
        $items = static::items($model);

        foreach ($items as $item) {
            if ($item::key() === $key) {
                return true;
            }
        }

        return false;
    }

    /**
     * Generate a class-string structure of all children and descendants
     *
     * @return array<class-string<Item|Container>, class-string<Item|Container>[]>
     */
    public static function itemStructure(Model $model): array
    {
        $structure = [];

        foreach (static::items($model) as $item) {
            $structure[$item] = is_a($item, Container::class, true) === true
                ? $item::itemStructure($model)
                : $item;
        }

        return $structure;
    }

    public static function nextItem(string $key, Model $model): Item|Container
    {
        if (static::hasItem($key, $model) === true) {
            $items = static::items($model);
            $index = static::itemIndex($key, $model);

            return new $items[$index]($model);
        }

        if (static::childHasItem($key, $model) === true) {

        }

        throw new ItemNotFoundException("Unable to find an item with the key \"$key\".");
    }

    public static function pathToItem(string $key, Model $model): array
    {
        $path = [];

        /*
         * [
         *   key => class,
         *   key => class,
         * ]
         */

        return $path;
    }

    // Utilities
    protected static function itemIndex(string $key, Model $model): int|false
    {
        $items = static::items($model);

        foreach ($items as $index => $item) {
            if ($item::key() === $key) {
                return $index;
            }
        }

        return false;
    }
}
