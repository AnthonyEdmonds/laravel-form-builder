<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Bases;

use AnthonyEdmonds\LaravelFormBuilder\Traits\Renderable;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;

abstract class Screen implements View
{
    use Renderable;

    // Setup
    public function __construct(protected Form $form, protected Model $subject)
    {
        //
    }
}
