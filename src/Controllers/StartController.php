<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Controllers;

use AnthonyEdmonds\LaravelFormBuilder\Items\Form;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;

class StartController extends Controller
{
    public function fresh(string $formKey): RedirectResponse
    {
        return Form::load($formKey)
            ->start()
            ->fresh();
    }

    public function show(string $formKey): View
    {
        return Form::load($formKey)
            ->start()
            ->show();
    }
}
