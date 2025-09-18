<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Traits\HasStates;

use AnthonyEdmonds\LaravelFormBuilder\Enums\State;
use AnthonyEdmonds\LaravelFormBuilder\Items\Form;
use AnthonyEdmonds\LaravelFormBuilder\Items\Task;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;

class MatchStatusTest extends TestCase
{
    protected Form $form;

    protected MyModel $model;

    protected Task $task;

    protected function setUp(): void
    {
        parent::setUp();

        $this->model = new MyModel();
        $this->model->id = 1;

        $this->form = new MyForm($this->model);
        $this->task = $this->form->tasks()->task('next-task');
    }

    #[DataProvider('expectations')]
    public function test(int $age, State $expected): void
    {
        $this->model->age = $age;

        $this->assertEquals(
            $expected,
            $this->task->matchStatus(),
        );
    }

    public static function expectations(): array
    {
        return [
            [
                'age' => 1,
                'expected' => State::ThereIsAProblem,
            ],
            [
                'age' => 2,
                'expected' => State::NotYetStarted,
            ],
            [
                'age' => 3,
                'expected' => State::Completed,
            ],
            [
                'age' => 4,
                'expected' => State::CannotStartYet,
            ],
            [
                'age' => 5,
                'expected' => State::InProgress,
            ],
            [
                'age' => 6,
                'expected' => State::NotRequired,
            ],
            [
                'age' => 7,
                'expected' => State::Incomplete,
            ],
            [
                'age' => 8,
                'expected' => State::Unknown,
            ],
        ];
    }
}
