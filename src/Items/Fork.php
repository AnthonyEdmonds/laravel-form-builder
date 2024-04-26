<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Items;

use AnthonyEdmonds\LaravelFormBuilder\Bases\Container;
use AnthonyEdmonds\LaravelFormBuilder\Bases\Form;
use AnthonyEdmonds\LaravelFormBuilder\Bases\Item;
use AnthonyEdmonds\LaravelFormBuilder\Exceptions\ForkNotFoundException;
use Illuminate\Database\Eloquent\Model;

abstract class Fork extends Container
{
    protected array $forks = [];

    abstract protected function selectFork(): string;

    public function __construct(Model $model, Form|Item|Container $parent)
    {
        parent::__construct($model, $parent);

        $fork = $this->selectFork();

        if (array_key_exists($fork, $this->forks) !== true) {
            throw new ForkNotFoundException("The \"$fork\" fork does not exist.");
        }

        $this->items = $this->forks[$fork];
    }
}
