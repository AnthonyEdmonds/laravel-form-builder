<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Items\Question\Item;

use AnthonyEdmonds\LaravelFormBuilder\Items\Question;
use AnthonyEdmonds\LaravelFormBuilder\Items\Task;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;

class IsEnabledTest extends TestCase
{
    protected MyForm $form;

    protected MyModel $model;

    protected Task $task;

    protected Question $question;

    protected function setUp(): void
    {
        parent::setUp();

        $this->model = new MyModel();
        $this->model->id = 1;

        $this->form = new MyForm($this->model);
        $this->task = $this->form->tasks()->task('my-task');
        $this->question = $this->task->question('name-question');
    }

    #[DataProvider('expectations')]
    public function test(
        bool $cannotStart,
        bool $notRequired,
        bool $expected,
    ): void {
        $this->model->cannot_start = $cannotStart;
        $this->model->not_required = $notRequired;

        $this->assertEquals(
            $expected,
            $this->question->isEnabled(),
        );
    }

    public static function expectations(): array
    {
        return [
            [
                'cannotStart' => true,
                'notRequired' => true,
                'expected' => false,
            ],
            [
                'cannotStart' => true,
                'notRequired' => false,
                'expected' => false,
            ],
            [
                'cannotStart' => false,
                'notRequired' => true,
                'expected' => false,
            ],
            [
                'cannotStart' => false,
                'notRequired' => false,
                'expected' => true,
            ],
        ];
    }
}
