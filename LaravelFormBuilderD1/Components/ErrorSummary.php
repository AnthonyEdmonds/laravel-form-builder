<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ErrorSummary extends Component
{
    public function __construct(public string $title = 'There is a problem') {
        //
    }

    public function render(): View
    {
        return view('form-builder::components.error-summary');
    }
}
