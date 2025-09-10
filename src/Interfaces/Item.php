<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Interfaces;

interface Item
{
    public static function key(): string;

    public function label(): string;

    public function route(): string;
}
