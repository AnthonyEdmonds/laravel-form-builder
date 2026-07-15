<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Questions\UploadFiles;

use AnthonyEdmonds\LaravelFormBuilder\Items\Form;
use AnthonyEdmonds\LaravelFormBuilder\Questions\UploadFiles;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyTask;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\UploadFilesQuestion;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class FieldsTest extends TestCase
{
    protected Form $form;

    protected MyModel $model;

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
        $this->assertField(
            [
                'name' => 'file',
                'label' => 'Which file would you like to upload?',
                'accept' => '',
                'displayName' => $this->question->displayName(),
                'hint' => 'You may upload a file of any size in any format',
            ],
            $this->question->fields()[0],
        );
    }

    public function testContextual(): void
    {
        $this->model->files->maxFileSize = 1234;
        $this->model->files->allowedMimes = [
            '.png',
            '.jpg',
        ];

        $this->assertField(
            [
                'name' => 'file',
                'label' => 'Which file would you like to upload?',
                'accept' => '.png,.jpg',
                'displayName' => $this->question->displayName(),
                'hint' => 'You may upload a file up to 1.21 KB in the following formats: .png or .jpg',
            ],
            $this->question->fields()[0],
        );
    }
}
