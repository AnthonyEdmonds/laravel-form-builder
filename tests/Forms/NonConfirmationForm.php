<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Forms;

class NonConfirmationForm extends MyForm
{
    public static function key(): string
    {
        return 'non-confirmation';
    }

    public function confirmationIsEnabled(): bool
    {
        return false;
    }
}
