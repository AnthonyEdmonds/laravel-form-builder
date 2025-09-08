<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Controllers;

use AnthonyEdmonds\LaravelFormBuilder\Items\Form;
use Illuminate\Contracts\View\View;
use Illuminate\Routing\Controller;

class QuestionController extends Controller
{
    public function show(string $formKey, string $taskKey, string $questionKey): View
    {
        return Form::load($formKey)
            ->tasks()
            ->task($taskKey)
            ->question($questionKey)
            ->show();
    }
}
