<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Items;

use AnthonyEdmonds\LaravelFormBuilder\Traits\HasItems;
use AnthonyEdmonds\LaravelFormBuilder\Traits\Renderable;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;

abstract class Item implements View
{
    use HasItems;
    use Renderable;
    
    protected Model $model;

    // Setup
    public function __construct(Model $model)
    {
        $this->model = $model;
    }
}
