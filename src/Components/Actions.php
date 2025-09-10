<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Actions extends Component
{
    public function __construct(
        public array $actions,
    ) {
        //
    }

    public function render(): View
    {
        return view('form-builder::components.actions');
    }
}
