<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Helpers\FormBuilderFileStore;

use AnthonyEdmonds\LaravelFileStore\FileStore;
use AnthonyEdmonds\LaravelFormBuilder\Helpers\FormBuilderFileStore;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class RemoveRouteTest extends TestCase
{
    protected FileStore $fileStore;

    protected function setUp(): void
    {
        parent::setUp();

        $this->fileStore = new FormBuilderFileStore();
        $this->fileStore->property = 'ddd';
    }

    public function test(): void
    {
        $this->assertEquals(
            route('forms.task.questions.files.remove', [
                'aaa',
                'bbb',
                'ccc',
                'ddd',
                'potato',
            ]),
            $this->fileStore->removeRoute('potato', [
                'form' => 'aaa',
                'task' => 'bbb',
                'question' => 'ccc',
            ]),
        );
    }
}
