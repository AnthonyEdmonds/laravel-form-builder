<?php

namespace AnthonyEdmonds\LaravelFormBuilder;

abstract class Fork extends FormItem
{
    /** @var array[] */
    protected array $forks = [
        'a' => [
            Task::class,
            Fork::class,
            Question::class,
        ],
        'b' => [
            Task::class,
            Fork::class,
            Question::class,
        ],
    ];

    abstract public function selectFork(): string;

    public function __construct(?FormItem $parent = null)
    {
        parent::__construct($parent);

        $this->questions = $this->forks[$this->selectFork()];
    }
}
