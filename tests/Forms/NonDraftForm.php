<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Forms;

use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\NonDraftModel;

class NonDraftForm extends MyForm
{
    public static function key(): string
    {
        return 'non-draft';
    }

    public static function modelClass(): string
    {
        return NonDraftModel::class;
    }
}
