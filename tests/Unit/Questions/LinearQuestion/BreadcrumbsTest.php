<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Questions\LinearQuestion;

use AnthonyEdmonds\LaravelFormBuilder\Forms\LinearForm;
use AnthonyEdmonds\LaravelFormBuilder\Items\Question;
use AnthonyEdmonds\LaravelFormBuilder\Task\LinearTask;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\LinearForm\LinearNameQuestion;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\LinearForm\MyLinearForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class BreadcrumbsTest extends TestCase
{
    protected LinearForm $form;

    protected MyModel $model;

    protected Question $question;

    protected function setUp(): void
    {
        parent::setUp();

        $this->model = new MyModel();
        $this->form = new MyLinearForm($this->model);
        $this->question = $this->form->tasks()
            ->task(LinearTask::key())
            ->question(LinearNameQuestion::key());
    }

    public function test(): void
    {
        $this->assertEquals(
            [
                $this->form->label(),
                $this->question->label() => $this->question->route(),
            ],
            $this->question->breadcrumbs(),
        );
    }
}
