<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Traits;

use AnthonyEdmonds\LaravelFormBuilder\Items\Item;

trait HasItems
{
    public const string KEY = '';
    
    /** @var Item[] */
    public const array ITEMS = [];

    // Actions
    /** Does this class or any of its children have the Item? */
    public function containsItem(string $key): bool
    {
        if ($this->hasItem($key) === true) {
            return true;
        }
        
        return $this->childHasItem($key) === true;
    }
    
    /** Retrieve an Item from any depth */
    public function getItem(string $key): Item|false
    {
        $itemIndex = static::itemIndex($key);
        
        if ($itemIndex !== false) {
            $itemClass = static::ITEMS[$itemIndex];
            return new $itemClass($model, $this);
        }
        
        foreach (static::ITEMS as $index => $item) {
            if ($this->containsItem($key) === true) {
                
            }
        }
        
        return false;
    }

    /** Does this class have the Item? */
    public function hasItem(string $key): bool
    {
        return $this->itemIndex($key) !== false;
    }
    
    /** Retrieve the next Item from this class */
    public function nextItem(string $currentItemKey): Item|false
    {

    }

    /** Retrieve the next Item from this class */
    public function previousItem(string $currentItemKey): Item|false
    {

    }
    
    // Utilities
    /** Is the Item nested within an Item of this class? */
    protected function childHasItem(string $key): bool
    {
        foreach (static::ITEMS as $item) {
            if ($item->containsItem($key) === true) {
                return true;
            }
        }
        
        return false;
    }
    
    /** Retrieve the index of an Item from this class */
    protected function itemIndex(string $key): int|false
    {
        foreach (static::ITEMS as $index => $item) {
            if ($item::KEY === $key) {
                return $index;
            }
        }

        return false;
    }
    
    /** @param Item[] $items */
    protected function searchItems(string $key, array $items): int|false
    {
        foreach ($items as $index => $item) {
            if ($item::KEY === $key) {
                return $index;
            }
        }
        
        return false;
    }
   
    
    
    public static function index(): array
    {
        $index = [];
        static::indexItems($index);
        
        return $index;
    }
    
    public static function indexItems(array &$index): void
    {
        $index[static::KEY] = [
            'class' => static::class,
            'items' => [],
        ];
        
        foreach (static::ITEMS as $item) {
            $item::indexItems($index[static::KEY]['items']);
        }
    }
}

/*
 * Build index of all parts
 * 
 * Find each part in route, one by one
 * When starting form, just begin at first item
 * form-key/task-key/fork-key/question-key
 * 
 * Navigate item structure, instantiating as needed; would mean instantiating every item just to get through the form
 * Path items are available in the URL, so not actually that blind!
 * Need to have tree structure of items by class name for forward / back navigation through items
 * [
 *     Form::class,
 *     Task::class,
 *     Fork:class,
 *     Question::class,
 * ];
 * 
 * Pass structure into item?
 * $item->structure;
 */
