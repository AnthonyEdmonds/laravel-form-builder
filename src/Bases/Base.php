<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Bases;

use Illuminate\Contracts\View\View;

abstract class Base implements View
{
    abstract public static function key(): string;
}
