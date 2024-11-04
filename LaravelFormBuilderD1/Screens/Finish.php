<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Screens;

use AnthonyEdmonds\LaravelFormBuilder\Bases\Screen;

class Finish extends Screen
{
    public static function key(): string
    {
        return 'finish';
    }

    public function name(): string
    {
        return 'form-builder::screens.finish';
    }
}
