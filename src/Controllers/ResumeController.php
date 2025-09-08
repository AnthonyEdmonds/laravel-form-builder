<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Controllers;

use AnthonyEdmonds\LaravelFormBuilder\Items\Form;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;

class ResumeController extends Controller
{
    public function fresh(string $formKey): RedirectResponse
    {
        return Form::load($formKey)
            ->resume()
            ->fresh();
    }

    public function resume(string $formKey): RedirectResponse
    {
        return Form::load($formKey)
            ->resume()
            ->resume();
    }

    public function show(string $formKey): View
    {
        return Form::load($formKey)
            ->resume()
            ->show();
    }
}
