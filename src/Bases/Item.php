<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Bases;

use AnthonyEdmonds\LaravelFormBuilder\Traits\HasKey;
use AnthonyEdmonds\LaravelFormBuilder\Traits\Renderable;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;

abstract class Item implements View
{
    use HasKey;
    use Renderable;

    // Setup
    public function __construct(protected Model $model)
    {
        //
    }
}
