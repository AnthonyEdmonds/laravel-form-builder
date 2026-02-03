<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Items\Question\Item;

use AnthonyEdmonds\LaravelFormBuilder\Items\Question;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyTask;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\NameQuestion;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\NextTask;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\ReadOnlyQuestion;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;

class IsEnabledTest extends TestCase
{
    protected MyForm $form;

    protected MyModel $model;

    protected Question $question;

    protected function setUp(): void
    {
        parent::setUp();

        $this->model = new MyModel();
        $this->model->id = 1;

        $this->form = new MyForm($this->model);
        $this->question = $this->form->tasks()
            ->task(
                MyTask::key(),
            )
            ->question(NameQuestion::key());
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

    public function testWhenNoInputs(): void
    {
        $this->question = $this->form->tasks()
            ->task(NextTask::key())
            ->question(ReadOnlyQuestion::key());

        $this->assertFalse(
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
