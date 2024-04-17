<?php

namespace AnthonyEdmonds\LaravelFormBuilder;

use AnthonyEdmonds\LaravelFormBuilder\Bases\FormItem;
use Illuminate\Database\Eloquent\Model;

abstract class Fork extends FormItem
{
    /** @var array[] */
    protected array $forks = [];

    abstract public function selectFork(): string;

    public function __construct(Model $subject, ?FormItem $parent = null)
    {
        parent::__construct($subject, $parent);

        $this->items = $this->forks[$this->selectFork()];
    }
}
