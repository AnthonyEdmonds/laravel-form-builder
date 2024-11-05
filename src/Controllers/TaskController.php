<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Controllers;

use AnthonyEdmonds\LaravelFormBuilder\Bases\Form;
use Illuminate\Contracts\View\View;

class TaskController {
    public function show(string $formKey, string $taskKey): View
    {
        return Form::load($formKey)
            ->task($taskKey)
            ->show();
    }
}
