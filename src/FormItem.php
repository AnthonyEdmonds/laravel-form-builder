<?php

namespace AnthonyEdmonds\LaravelFormBuilder;

use Illuminate\Support\Collection;

abstract class FormItem
{
    public const string EDIT = 'edit';

    public const string KEY = '';

    public const string NEW = 'new';

    public const string REVIEW = 'review';

    public const array MODES = [
        self::EDIT,
        self::NEW,
        self::REVIEW,
    ];

    protected ?self $parent = null;

    /** @var FormItem[] */
    protected array $questions = [];

    public function __construct(?FormItem $parent = null)
    {
        $this->parent = $parent;
    }

    public function routes(): Collection
    {
        $routes = new Collection();

        // TODO Current, Previous, Next, Start, Summary, Finish

        return $routes;
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
