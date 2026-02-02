<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Forms;

use AnthonyEdmonds\LaravelFormBuilder\Items\Tasks;

class RecoverableForm extends MyForm
{
    public static function key(): string
    {
        return 'recoverable-form';
    }

    public function tasks(): Tasks
    {
        return new RecoverableTasks($this);
    }
}