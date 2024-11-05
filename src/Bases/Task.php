<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Bases;

use AnthonyEdmonds\LaravelFormBuilder\Enums\Colour;
use AnthonyEdmonds\LaravelFormBuilder\Exceptions\FormNotFoundException;
use AnthonyEdmonds\LaravelFormBuilder\Interfaces\UsesStates;

abstract class Task extends Base implements UsesStates
{
    /** @return Question[] The Questions which make up this Task */
    abstract public function questions(): array;

    // Setup
    public function __construct(public readonly Form $form)
    {
        //
    }

    // UsesStates
    public function statusColour(): Colour
    {
        return $this->status()->colour();
    }

    // Questions
    public function question(string $questionKey): Question
    {
        $questions = $this->questions();

        foreach ($questions as $question) {
            if ($question::key() === $questionKey) {
                return $question;
            }
        }

        $taskKey = static::key();
        throw new FormNotFoundException("No question has been registered to the \"$taskKey\" task with the key \"$questionKey\"");
    }
}
