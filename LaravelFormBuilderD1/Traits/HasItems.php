<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Traits;

use AnthonyEdmonds\LaravelFormBuilder\Bases\Container;
use AnthonyEdmonds\LaravelFormBuilder\Bases\Item;
use AnthonyEdmonds\LaravelFormBuilder\Exceptions\ItemNotFoundException;
use AnthonyEdmonds\LaravelFormBuilder\Items\Fork;
use Illuminate\Database\Eloquent\Model;

trait HasItems
{
    /** @var array<string, class-string<Item>> $index Cache of the Items index */
    public readonly array $index;

    // Items
    /** @return class-string<Item>[] A list of Items and Containers by class-string */
    abstract public static function items(Model $model): array;
    
    /** @return array<string, class-string<Item>> Paths to every Item and child in linear order */
    public static function index(Model $model, string $path = ''): array
    {
        $index = [];
        $items = static::items($model);
        
        foreach ($items as $item) {
            if (is_a($item, Fork::class, true) !== true ) {
                $key = $path.$item::key();
                $index[$key] = $item;
            }

            if (is_a($item, Container::class, true) === true) {
                $index = array_merge($index, $item::index($model, $path.$item::key().'/'));
            }
        }

        return $index;
    }

    /** @return array<string, class-string<Item>> Paths to every Item and child in linear order */
    protected function indexItems(Model $model): array
    {
        if (isset($this->index) === false) {
            $this->index = static::index($model);
        }

        return $this->index;
    }

    /** @return class-string<Item> Retrieve a child Item at a given path */
    public function itemAtPath(string $path): string
    {
        return array_key_exists($path, $this->index) === true
            ? $this->index[$path]
            : throw new ItemNotFoundException("No Item was found at the path \"$path\"");
    }

    // Pathing
    /** Path to the first Item */
    public function firstItemPath(): string
    {
        return array_key_first($this->index);
    }

    /** Path to the next Item */
    public function nextItemPath(string $currentPath): ?string
    {
        $itemPaths = array_keys($this->index);
        $currentItemIndex = array_search($currentPath, $itemPaths);
        return $itemPaths[$currentItemIndex + 1] ?? null;
    }

    /** Path to the previous Item */
    public function previousItemPath(string $currentPath): ?string
    {
        $itemPaths = array_keys($this->index);
        $currentItemIndex = array_search($currentPath, $itemPaths);
        return $itemPaths[$currentItemIndex - 1] ?? null;
    }

    /** Path to the last Item */
    public function lastItemPath(): string
    {
        return array_key_last($this->index);
    }
}
