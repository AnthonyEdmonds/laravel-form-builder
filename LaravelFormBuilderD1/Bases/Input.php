<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Bases;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

abstract class Input extends Component
{
    // Setup
    public function __construct(
        public string $label,
        public string $name,
        public string $autocomplete = 'on',
        public ?string $hint = null,
        public ?string $id = null,
        public string $type = 'text',
        public mixed $value = null,
    ) {
        $this->id = $id ?? $name;

        $this->value = old($this->name, $this->value);
    }

    // View
    public function render(): View
    {
        return view($this->blade(), $this->data());
    }

    public function blade(): string
    {
        return "form-builder::components.$this->type";
    }
}
