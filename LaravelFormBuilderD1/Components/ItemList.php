<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ItemList extends Component
{
    public function __construct(
        public array $items,
        public bool $showEdit = true,
    ) {
        //
    }

    public function render(): View
    {
        return view('form-builder::components.item-list');
    }
}
