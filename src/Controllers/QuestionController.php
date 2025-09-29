<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Controllers;

use AnthonyEdmonds\LaravelFormBuilder\Items\Form;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;

class QuestionController extends Controller
{
    public function show(string $formKey, string $taskKey, string $questionKey): View
    {
        return Form::load($formKey)
            ->checkAccess()
            ->tasks()
            ->checkAccess()
            ->task($taskKey)
            ->checkAccess()
            ->question($questionKey)
            ->checkAccess()
            ->show();
    }

    public function save(
        FormRequest $request,
        string $formKey,
        string $taskKey,
        string $questionKey,
    ): RedirectResponse {
        return Form::load($formKey)
            ->checkAccess()
            ->tasks()
            ->checkAccess()
            ->task($taskKey)
            ->checkAccess()
            ->question($questionKey)
            ->checkAccess()
            ->save($request);
    }

    public function skip(
        FormRequest $request,
        string $formKey,
        string $taskKey,
        string $questionKey,
    ): RedirectResponse {
        return Form::load($formKey)
            ->checkAccess()
            ->tasks()
            ->checkAccess()
            ->task($taskKey)
            ->checkAccess()
            ->question($questionKey)
            ->checkAccess()
            ->skip($request);
    }
}
