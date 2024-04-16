<?php

namespace AnthonyEdmonds\LaravelFormBuilder;

use Illuminate\Contracts\View\View;

class FormController
{
    public function get(string $formKey, string $mode = FormItem::NEW, string $keys = ''): View
    {
        // TODO Determine what to do based on item type
    }

    public function post(string $formKey, string $mode = FormItem::NEW, string $keys = ''): View
    {
        // TODO Determine what to do based on item type
    }

    public function delete(string $formKey, string $mode = FormItem::NEW, string $keys = ''): View
    {
        // TODO Determine what to do based on item type
    }

    protected function getKeys(string $keys): array
    {
        return explode('.', $keys);
    }
}
