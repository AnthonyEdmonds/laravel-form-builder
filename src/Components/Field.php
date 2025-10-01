<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Components;

use AnthonyEdmonds\LaravelFormBuilder\Helpers\Field as FieldHelper;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Field extends Component
{
    public function __construct(
        public FieldHelper $field,
    ) {
        //
    }

    public function render(): View
    {
        return view("form-builder::components.{$this->field->blade}");
    }
}
