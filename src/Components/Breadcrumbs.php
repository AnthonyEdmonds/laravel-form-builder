<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Breadcrumbs extends Component
{
    public function __construct(
        public array $breadcrumbs,
    ) {
        //
    }

    public function render(): View
    {
        return view('form-builder::components.breadcrumbs');
    }
}
