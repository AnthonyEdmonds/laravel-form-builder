<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Items;

use AnthonyEdmonds\LaravelFormBuilder\Interfaces\Item as ItemInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Throwable;

abstract class Item implements ItemInterface
{
    use AuthorizesRequests;

    public readonly string $key;

    public function __construct()
    {
        $this->key = static::key();
    }

    // Item
    abstract public static function key(): string;

    abstract public function label(): string;

    abstract public function backLabel(): string;

    // Access
    public function checkAccess(): static
    {
        return $this;
    }

    public function canAccess(): bool
    {
        try {
            $this->checkAccess();
            return true;
        } catch (Throwable $throwable) {
            return false;
        }
    }

    public function isEnabled(): bool
    {
        return true;
    }
}
