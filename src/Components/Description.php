<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Description extends Component
{
    public function __construct(
        public array $description,
    ) {
        //
    }

    public function render(): View
    {
        return view('form-builder::components.description');
    }
}
