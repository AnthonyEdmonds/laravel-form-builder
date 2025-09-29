<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Controllers;

use AnthonyEdmonds\LaravelFormBuilder\Items\Form;
use Illuminate\Contracts\View\View;
use Illuminate\Routing\Controller;

class TaskController extends Controller
{
    public function show(string $formKey, string $taskKey): View
    {
        return Form::load($formKey)
            ->checkAccess()
            ->tasks()
            ->checkAccess()
            ->task($taskKey)
            ->checkAccess()
            ->show();
    }
}
