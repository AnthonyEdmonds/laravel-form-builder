<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Items;

use AnthonyEdmonds\LaravelFormBuilder\Bases\Item;
use AnthonyEdmonds\LaravelFormBuilder\Traits\Renderable;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

abstract class Question extends Item implements View
{
    use Renderable;

    public function save(): RedirectResponse
    {
        $this->model->save();
    }

    public function skip(): RedirectResponse
    {
        //
    }

    public function delete(): RedirectResponse
    {
        //
    }
}
