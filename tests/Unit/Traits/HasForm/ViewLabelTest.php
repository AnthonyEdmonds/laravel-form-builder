<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Traits\HasForm;

use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class ViewLabelTest extends TestCase
{
    protected MyModel $model;

    protected function setUp(): void
    {
        parent::setUp();

        $this->model = new MyModel();
        $this->model->id = 1;
    }

    public function test(): void
    {
        $this->assertEquals(
            'View My Model',
            $this->model->viewLabel(),
        );
    }
}
