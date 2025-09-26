<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Controllers;

use AnthonyEdmonds\LaravelFormBuilder\Items\Form;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;

class ResumeController extends Controller
{
    public function show(string $formKey): View
    {
        return Form::load($formKey)
            ->resume()
            ->show();
    }

    public function restart(string $formKey): RedirectResponse
    {
        return Form::load($formKey)
            ->resume()
            ->restart();
    }
}
