<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Items;

use AnthonyEdmonds\LaravelFormBuilder\Exceptions\InvalidForkException;
use Illuminate\Database\Eloquent\Model;

abstract class Fork extends Item
{
    /** @var array[] */
    protected array $forks = [];

    abstract public function selectFork(): string;

    public function __construct(Model $model)
    {
        parent::__construct($model);

        $currentFork = $this->selectFork();
        
        if (array_key_exists($currentFork, $this->forks) === true) {
            throw new InvalidForkException("\"$currentFork\" does not exist as an option on this fork.");
        }

        $this->items = $this->forks[$currentFork];
    }
}
