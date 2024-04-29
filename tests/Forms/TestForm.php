<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Forms;

use AnthonyEdmonds\LaravelFormBuilder\Bases\Form;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\Items\ForkOne;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\Items\QuestionOne;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\Items\QuestionSix;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\Items\TaskOne;

class TestForm extends Form
{
    public const string KEY = 'my-form';

    protected array $items = [
        QuestionOne::class,
        TaskOne::class,
        ForkOne::class,
        QuestionSix::class,
    ];

    protected function quitFormRoute(): string
    {
        return route('quit');
    }
}
