<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Interfaces;

interface Item
{
    public static function key(): string;

    public function label(): string;

    public function route(): string;

    public function backLabel(): string;

    // Access
    public function canAccess(): bool;

    /** Throw an exception or return the Item */
    public function checkAccess(): static;

    public function isEnabled(): bool;
}
