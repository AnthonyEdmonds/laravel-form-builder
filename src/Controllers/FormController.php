<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Controllers;

use AnthonyEdmonds\LaravelFormBuilder\Items\Form;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;

class FormController extends Controller
{
    public function new(string $formKey): RedirectResponse
    {
        return Form::new($formKey);
    }

    public function edit(string $formKey, string $modelKey): RedirectResponse
    {
        return Form::edit($formKey, $modelKey);
    }

    public function submit(string $formKey): RedirectResponse
    {
        return Form::load($formKey)->submit();
    }

    public function draft(string $formKey): RedirectResponse
    {
        return Form::load($formKey)->draft();
    }

    public function exit(string $formKey): RedirectResponse
    {
        return Form::load($formKey)->exit();
    }
}
