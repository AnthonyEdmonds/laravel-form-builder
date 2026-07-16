<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Questions\UploadFiles;

use AnthonyEdmonds\LaravelFileStore\File;
use AnthonyEdmonds\LaravelFormBuilder\Interfaces\UsesForm;
use AnthonyEdmonds\LaravelFormBuilder\Items\Form;
use AnthonyEdmonds\LaravelFormBuilder\Questions\UploadFiles;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyTask;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\UploadFilesQuestion;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class SecondarySummariesTest extends TestCase
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

        $this->model->files->add($this->makeFile());
        $this->model->id = 1;
    }

    public function test(): void
    {
        /** @var File $file */
        $file = array_first($this->model->files->files);

        $this->assertEquals(
            [
                [
                    'label' => $file->name,
                    'value' => $file->size,
                    'actions' => [
                        [
                            'label' => 'View',
                            'url' => route('forms.files.download', [
                                MyForm::key(),
                                1,
                                'files',
                                $file->hash,
                            ]),
                        ],
                    ],
                ],
            ],
            $this->question->secondarySummaries(),
        );
    }
}
