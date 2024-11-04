<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Controllers;

use AnthonyEdmonds\LaravelFormBuilder\Bases\Form;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ItemController
{
    public function show(string $formKey, string $keys = ''): View
    {
        $keys = $this->getKeys($keys);
        Form::load($formKey)->item($keys)->show();

        // TODO Load Item by Keys
        // TODO Return Item as it is renderable
    }

    public function save(string $formKey, string $keys = ''): RedirectResponse
    {
        $keys = $this->getKeys($keys);
        Form::load($formKey);

        // TODO Load Item by Keys
        // TODO Save Item
    }

    public function skip(string $formKey, string $keys = ''): RedirectResponse
    {
        $keys = $this->getKeys($keys);
        Form::load($formKey);

        // TODO Load Item by Keys
        // TODO Skip Item
    }

    public function delete(string $formKey, string $keys = ''): RedirectResponse
    {
        $keys = $this->getKeys($keys);
        Form::load($formKey);

        // TODO Load Item by Keys
        // TODO Delete Item
    }

    protected function getKeys(string $keys): array
    {
        return explode('/', $keys);
    }
}
