<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Bases;

use AnthonyEdmonds\LaravelFormBuilder\Traits\HasItems;
use Illuminate\Database\Eloquent\Model;

abstract class Container extends Item
{
    use HasItems;

    public function __construct(Model $model, Form|Container|Item $parent, bool $populate = true)
    {
        parent::__construct($model, $parent);

        if ($populate === true) {
            $this->populateItems();
        }
    }
}
