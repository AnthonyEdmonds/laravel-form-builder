<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Controllers;

use AnthonyEdmonds\LaravelFormBuilder\Items\Form;
use Illuminate\Contracts\View\View;
use Illuminate\Routing\Controller;

class ResumeController extends Controller
{
    public function show(string $formKey): View
    {
        return Form::load($formKey)
            ->resume()
            ->show();
    }
}
