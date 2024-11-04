<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Items;

use AnthonyEdmonds\LaravelFormBuilder\Bases\Form;
use AnthonyEdmonds\LaravelFormBuilder\Bases\Question as BaseQuestion;
use AnthonyEdmonds\LaravelFormBuilder\Bases\Input;
use Illuminate\Database\Eloquent\Model;

abstract class Questions extends BaseQuestion
{
    /** @var Input[] */
    public array $inputs;

    // Setup
    public function __construct(Form $form, Model $model)
    {
        parent::__construct($form, $model);

        $this->inputs = $this->inputs();
    }

    // Input
    /** @return Input[] The questions being asked */
    abstract public function inputs(): array;

    // View
    public function toArray(): array
    {
        return array_merge(
            parent::toArray(),
            [
                'inputs' => $this->inputs,
            ],
        );
    }

    /** @return array<string, scalar> Format this Question for review */
    public function check(): array
    {
        $formatted = [];

        foreach ($this->inputs as $input) {
            $formatted[ucfirst($input->name)] = $input->value;
        }

        return $formatted;
    }
}
