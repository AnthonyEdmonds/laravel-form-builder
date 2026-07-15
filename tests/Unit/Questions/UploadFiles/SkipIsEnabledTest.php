<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Questions\UploadFiles;

use AnthonyEdmonds\LaravelFormBuilder\Interfaces\UsesForm;
use AnthonyEdmonds\LaravelFormBuilder\Items\Form;
use AnthonyEdmonds\LaravelFormBuilder\Questions\UploadFiles;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyTask;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\UploadFilesQuestion;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class SkipIsEnabledTest extends TestCase
{
    protected Form $form;

    protected UsesForm $model;

    protected UploadFiles $question;

    protected function setUp(): void
    {
        parent::setUp();

        $this->useFileStores();

        $this->model = new MyModel();
        $this->form = new MyForm($this->model);
        $this->question = $this->form->tasks()
            ->task(MyTask::key())
            ->question(UploadFilesQuestion::key());
    }

    public function testTrueWhen(): void
    {
        $this->model->files->add($this->makeFile());

        $this->assertTrue(
            $this->question->skipIsEnabled(),
        );
    }

    public function testFalseWhen(): void
    {
        $this->assertFalse(
            $this->question->skipIsEnabled(),
        );
    }
}
