<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Items;

use AnthonyEdmonds\LaravelFormBuilder\Bases\Form;
use AnthonyEdmonds\LaravelFormBuilder\Bases\Input;
use AnthonyEdmonds\LaravelFormBuilder\Bases\Question as BaseQuestion;
use Illuminate\Database\Eloquent\Model;

abstract class Question extends BaseQuestion
{
    public Input $input;
    
    // Setup
    public function __construct(Form $form, Model $model)
    {
        parent::__construct($form, $model);
        
        $this->input = $this->input();
    }

    // Input
    /** The question being asked */
    abstract public function input(): Input;

    // View
    /** The title of the Question page, by default the label of the Input */
    public function title(): string
    {
        return $this->input->label;
    }
    
    public function toArray(): array
    {
        return array_merge(
            parent::toArray(),
            [
                'inputs' => [$this->input],
            ],
        );
    }

    /** @return array<string, scalar> Format this Question for review */
    public function check(): array
    {
        return [
            ucfirst($this->input->name) => $this->input->value,
        ];
    }
}
