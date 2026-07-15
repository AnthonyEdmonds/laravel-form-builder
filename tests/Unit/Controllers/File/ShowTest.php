<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Controllers\File;

use AnthonyEdmonds\LaravelFormBuilder\Controllers\FileController;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyTask;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\NameQuestion;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ShowTest extends TestCase
{
    protected FileController $controller;

    protected StreamedResponse $file;

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
        $this->file = $this->controller->show(
            MyForm::key(),
            MyTask::key(),
            NameQuestion::key(),
            'files',
            $this->uploadedFile->hashName(),
        );
    }

    public function test(): void
    {
        $this->assertStringContainsString(
            'snowy.jpg',
            $this->file->headers->get('content-disposition'),
        );
    }
}
