<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Controllers\File;

use AnthonyEdmonds\LaravelFormBuilder\Controllers\FileController;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyTask;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\NameQuestion;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\UploadedFile;

class RemoveTest extends TestCase
{
    protected FileController $controller;

    protected RedirectResponse $redirect;

    protected MyModel $model;

    protected UploadedFile $uploadedFile;

    protected function setUp(): void
    {
        parent::setUp();

        $this->useFileStores();
        $this->useDatabase();
        $this->model = $this->startFormSession();

        $this->uploadedFile = new UploadedFile(
            __DIR__ . '/../../../Files/snowy.jpg',
            'snowy.jpg',
        );

        $this->model->files->add($this->uploadedFile);

        $this->controller = new FileController();
        $this->redirect = $this->controller->remove(
            MyForm::key(),
            MyTask::key(),
            NameQuestion::key(),
            'files',
            $this->uploadedFile->hashName(),
        );
    }

    public function test(): void
    {
        $this->assertTrue(
            $this->model->files->files[$this->uploadedFile->hashName()]->remove,
        );

        $this->assertEquals(
            route('forms.task.questions.show', [
                MyForm::key(),
                MyTask::key(),
                NameQuestion::key(),
            ]),
            $this->redirect->getTargetUrl(),
        );
    }
}
