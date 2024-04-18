<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Bases;

use Illuminate\Database\Eloquent\Model;

abstract class FormItem
{
    public const string KEY = '';

    protected ?self $parent = null;

    /** @var FormItem[] */
    protected array $items = [];

    protected Model $subject;

    public function __construct(Model $subject, ?FormItem $parent = null)
    {
        $this->subject = $subject;
        $this->parent = $parent;
    }

    /**
     * @return array{current: string, exit: string, finish: string, next: string, previous: string, start: string, summary: string}
     */
    public function routes(string $currentKey, string $mode): array
    {
        $formKey = ''; // Top level parent key
        $keys = ''; // Replace with context level keys

        return [
            'current' => route('form-builder.get', [$formKey, $mode, $keys]), // Combination of all parent keys
            'exit' => route(''), // Form exit route
            'finish' => route('form-builder.get', [$formKey, $mode, $keys]), // First finish item in top-level parent
            'next' => route('form-builder.get', [$formKey, $mode, $keys]), // Next item in parent, combined with all parent keys
            'previous' => route('form-builder.get', [$formKey, $mode, $keys]), // Last item in parent, combined with all parent keys
            'start' => route('form-builder.get', [$formKey, $mode, $keys]), // Top-level parent key
            'summary' => route('form-builder.get', [$formKey, $mode, $keys]), // First summary item in top-level parent
        ];
    }

    /*
    public function parseRoute(array $route): Question
    {
        $currentKey = array_pop($route);

        foreach ($this->questions as $question) {
            if ($currentKey === $question::KEY) {
                ** @var FormItem $item *
                $item = new $question($this);

                return is_a($item, Question::class) !== true
                    ? $item->parseRoute($route)
                    : $item;
            }
        }
    }

    public function previousRoute(): string
    {
        // If first key in parent, call parent previous
    }
    */
}
