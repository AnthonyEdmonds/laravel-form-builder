<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Items;

use AnthonyEdmonds\LaravelFormBuilder\Interfaces\Item as ItemInterface;

abstract class Item implements ItemInterface
{
    public readonly string $key;

    public function __construct()
    {
        $this->key = static::key();
    }

    // Item
    abstract public static function key(): string;
}
