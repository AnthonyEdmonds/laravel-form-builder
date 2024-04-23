<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Items;

use AnthonyEdmonds\LaravelFormBuilder\Bases\Item;
use AnthonyEdmonds\LaravelFormBuilder\Traits\Renderable;
use Illuminate\Contracts\View\View;

abstract class Question extends Item implements View
{
    use Renderable;

    public function save(): void
    {
        $this->model->save();
    }

    public function skip(): void
    {
        //
    }

    public function delete(): void
    {
        //
    }
}
