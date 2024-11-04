<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FormGroup extends Component
{
    public function __construct(
        public string $label,
        public string $name,
        public ?string $hint = null,
    ) {
        //
    }

    public function render(): View
    {
        return view('form-builder::components.form-group');
    }
}
