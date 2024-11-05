<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Controllers;

use AnthonyEdmonds\LaravelFormBuilder\Bases\Form;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\RedirectResponse;

class QuestionController {
    public function show(string $formKey, string $taskKey, string $questionKey): View
    {
        return Form::load($formKey)
            ->task($taskKey)
            ->question($questionKey)
            ->show();
    }

    public function save(FormRequest $request, string $formKey, string $taskKey, string $questionKey): RedirectResponse
    {
        return Form::load($formKey)
            ->task($taskKey)
            ->question($questionKey)
            ->save($request);
    }

    public function skip(FormRequest $request, string $formKey, string $taskKey, string $questionKey): RedirectResponse
    {
        return Form::load($formKey)
            ->task($taskKey)
            ->question($questionKey)
            ->skip($request);
    }
}
