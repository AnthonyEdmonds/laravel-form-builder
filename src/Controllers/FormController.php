<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Controllers;

use AnthonyEdmonds\LaravelFormBuilder\Bases\Form;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class FormController {
    public function start(string $formKey, ?string $modelKey = null): RedirectResponse
    {
        return Form::new($formKey, $modelKey)->start();
    }

    public function fresh(string $formKey, ?string $modelKey = null): RedirectResponse
    {
        return Form::new($formKey, $modelKey)->fresh();
    }

    public function resume(string $formKey): View
    {
        return Form::load($formKey)->resume();
    }

    public function begin(string $formKey): View
    {
        return Form::load($formKey)->begin();
    }

    public function check(string $formKey): View
    {
        return Form::load($formKey)->check();
    }

    public function save(string $formKey): RedirectResponse
    {
        return Form::load($formKey)->saveDraft();
    }

    public function submit(string $formKey): RedirectResponse
    {
        return Form::load($formKey)->submit();
    }

    public function finish(string $formKey): View
    {
        return Form::load($formKey)->finish();
    }

    public function exit(string $formKey): RedirectResponse
    {
        return Form::load($formKey)->exit();
    }
}
