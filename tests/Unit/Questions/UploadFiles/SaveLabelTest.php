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

class SaveLabelTest extends TestCase
{
    protected Form $form;

    protected UsesForm $model;

    protected UploadFiles $question;

    protected function setUp(): void
    {
        parent::setUp();

        $this->model = new MyModel();
        $this->form = new MyForm($this->model);
        $this->question = $this->form->tasks()
            ->task(MyTask::key())
            ->question(UploadFilesQuestion::key());
    }

    public function test(): void
    {
        $this->assertEquals(
            'Upload file',
            $this->question->saveLabel(),
        );
    }
}
