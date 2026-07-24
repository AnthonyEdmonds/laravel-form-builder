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
use Illuminate\Http\UploadedFile;

class SecondarySummariesTest extends TestCase
{
    protected Form $form;

    protected UsesForm $model;

    protected UploadFiles $question;

    protected UploadedFile $toAdd;

    protected UploadedFile $toRemove;

    protected function setUp(): void
    {
        parent::setUp();

        $this->useFileStores();

        $this->model = new MyModel();
        $this->model->id = 1;

        $this->form = new MyForm($this->model);
        $this->question = $this->form->tasks()
            ->task(MyTask::key())
            ->question(UploadFilesQuestion::key());

        $this->toAdd = $this->makeFile();
        $this->toRemove = $this->makeFile();
    }

    public function test(): void
    {
        $this->model->files->add($this->toAdd);

        $this->model->files->add($this->toRemove);
        $this->model->files->remove($this->toRemove->hashName());

        $this->model->files->files['test'] = new File(
            $this->model->files,
            'test',
            'test.png',
            '10 KB',
            true,
        );

        /** @var File $file */
        $file = $this->model->files->files[$this->toAdd->hashName()];

        $summaries = $this->question->secondarySummaries();

        $this->assertCount(2, $summaries);

        $this->assertEquals(
            [
                'label' => 'test.png',
                'value' => '10 KB',
                'actions' => [
                    [
                        'label' => 'View',
                        'url' => $this->model->files->downloadRoute(
                            $this->model->files->files['test']->hash,
                            [
                                'form' => MyForm::key(),
                                'model' => 1,
                            ],
                        ),
                    ],
                ],
            ],
            $summaries['test.png'],
        );

        $this->assertEquals(
            [
                'label' => $file->name,
                'value' => $file->size,
                'actions' => [
                    [
                        'label' => 'View',
                        'url' => $this->model->files->downloadRoute($file->hash, [
                            'form' => MyForm::key(),
                            'task' => MyTask::key(),
                            'question' => UploadFilesQuestion::key(),
                        ]),
                    ],
                ],
            ],
            $summaries[$file->name],
        );
    }

    public function testWhenEmpty(): void
    {
        $this->assertEquals(
            [
                'No files have been uploaded' => '',
            ],
            $this->question->secondarySummaries(),
        );
    }
}
