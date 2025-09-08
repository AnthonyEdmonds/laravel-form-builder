<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Items;

use AnthonyEdmonds\LaravelFormBuilder\Interfaces\Item as ItemInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class Start extends Item implements ItemInterface
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
        return 'start';
    }

    public function route(): string
    {
        return route('forms.start.show', $this->form->key);
    }

    // Actions
    public function fresh(): RedirectResponse
    {
        // TODO
    }

    public function show(): View
    {
        // TODO
    }
}
