<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Items;

use AnthonyEdmonds\LaravelFormBuilder\Interfaces\Item as ItemInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class Resume extends Item implements ItemInterface
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
        return 'resume';
    }

    public function route(): string
    {
        return route('forms.resume.show', $this->form->key);
    }

    // Actions
    public function fresh(): RedirectResponse
    {
        // TODO
    }

    public function resume(): RedirectResponse
    {
        // TODO
    }

    public function show(): View
    {
        // TODO
    }
}
