<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Forms;

class NonStartForm extends MyForm
{
    public static function key(): string
    {
        return 'non-start';
    }

    public function startIsEnabled(): bool
    {
        return false;
    }
}
