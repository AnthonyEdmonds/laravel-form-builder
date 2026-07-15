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
use Illuminate\Contracts\View\View;

class ShowTest extends TestCase
{
    protected Form $form;

    protected UsesForm $model;

    protected UploadFiles $question;

    protected View $view;

    protected function setUp(): void
    {
        parent::setUp();

        $this->useFileStores();

        $this->model = new MyModel();
        $this->form = new MyForm($this->model);
        $this->question = $this->form->tasks()
            ->task(MyTask::key())
            ->question(UploadFilesQuestion::key());

        $this->model->files->add($this->makeFile());
        $this->model->files->add($this->makeFile());
        $this->model->files->add($this->makeFile());

        $this->view = $this->question->show();
    }

    public function test(): void
    {
        $data = $this->view->getData();

        $this->assertEquals(
            $this->model->files->list([
                'form' => MyForm::key(),
                'task' => MyTask::key(),
                'question' => UploadFilesQuestion::key(),
            ]),
            $data['filesList'],
        );

        $this->assertEquals(
            '1 file',
            $data['filesMinimum'],
        );

        $this->assertEquals(
            $this->model->files->maxFilesString(),
            $data['filesLimit'],
        );

        $this->assertEquals(
            $this->model->files->countString(),
            $data['filesCurrent'],
        );

        $this->assertEquals(
            $this->model->files->currentStoreSizeString(),
            $data['storeCurrent'],
        );

        $this->assertEquals(
            $this->model->files->maxStoreSizeString(),
            $data['storeLimit'],
        );
    }
}
