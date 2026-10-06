<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Questions\LinearQuestion;

use AnthonyEdmonds\LaravelFormBuilder\Forms\LinearForm;
use AnthonyEdmonds\LaravelFormBuilder\Items\Question;
use AnthonyEdmonds\LaravelFormBuilder\Task\LinearTask;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\LinearForm\LinearAgeQuestion;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\LinearForm\LinearNameQuestion;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\LinearForm\MyLinearForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class ActionsTest extends TestCase
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

    public function testToSummary(): void
    {
        $this->question->returnToSummary = true;
        $actions = $this->question->actions();

        $this->assertEquals(
            'Back to check answers',
            $actions['back']->label,
        );

        $this->assertEquals(
            $this->form->summary()->route(),
            $actions['back']->link,
        );
    }

    public function testToExit(): void
    {
        $actions = $this->question->actions();

        $this->assertEquals(
            $this->form->exitLabel(),
            $actions['back']->label,
        );

        $this->assertEquals(
            $this->form->exitRoute(),
            $actions['back']->link,
        );
    }

    public function testToPrevious(): void
    {
        $ageQuestion = $this->form->tasks()
            ->task(LinearTask::key())
            ->question(LinearAgeQuestion::key());

        $actions = $ageQuestion->actions();

        $this->assertEquals(
            'Previous question',
            $actions['back']->label,
        );

        $this->assertEquals(
            $this->question->route(),
            $actions['back']->link,
        );
    }
}
