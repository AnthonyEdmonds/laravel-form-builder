<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Items;

use AnthonyEdmonds\LaravelFormBuilder\Bases\Container;
use AnthonyEdmonds\LaravelFormBuilder\Bases\Form;
use AnthonyEdmonds\LaravelFormBuilder\Bases\Item;
use AnthonyEdmonds\LaravelFormBuilder\Exceptions\ForkNotFoundException;
use Illuminate\Database\Eloquent\Model;

abstract class Fork extends Container
{
    /**
     * Multiple lists of Items and Containers by class-string
     * Keyed by a string which must match an option returned by selectFork()
     *
     * @var array<string, class-string<Item|Container>[]>
     */
    protected array $forks = [];

    /** @return string Key in $forks for the available set of Items */
    abstract protected function selectFork(): string;

    public function __construct(Model $model, Form|Item|Container $parent)
    {
        $fork = $this->selectFork();

        if (array_key_exists($fork, $this->forks) !== true) {
            throw new ForkNotFoundException("The \"$fork\" fork does not exist.");
        }

        $this->items = $this->forks[$fork];

        parent::__construct($model, $parent);
    }
}
