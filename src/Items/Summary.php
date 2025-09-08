<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Items;

use AnthonyEdmonds\LaravelFormBuilder\Interfaces\Item as ItemInterface;
use Illuminate\Contracts\View\View;

class Summary extends Item implements ItemInterface
{
    // Setup
    final public function __construct(
        public Form $form,
    ) {
        parent::__construct();
    }

    // Item
    public static function key(): string
    {
        return 'summary';
    }

    public function route(): string
    {
        return route('forms.summary.show', $this->form->key);
    }

    // Actions
    public function show(): View
    {
        // TODO
    }
}
