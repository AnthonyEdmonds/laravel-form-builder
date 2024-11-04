<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Screens;

use AnthonyEdmonds\LaravelFormBuilder\Bases\Screen;

class Begin extends Screen
{
    public static function key(): string
    {
        return 'begin';
    }

    public function name(): string
    {
        return 'form-builder::screens.begin';
    }

    public function backRoute(): string
    {
        return $this->form->exitRoute();
    }

    public function nextRoute(): string
    {
        return $this->form->firstItemRoute();
    }
}
