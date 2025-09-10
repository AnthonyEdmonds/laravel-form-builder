<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Helpers\Model;

use AnthonyEdmonds\LaravelFormBuilder\Helpers\ModelHelper;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class LoadModelFromDatabaseTest extends TestCase
{
    protected MyModel $model;

    protected function setUp(): void
    {
        parent::setUp();

        $this->useDatabase();

        $this->model = new MyModel();
        $this->model->save();
    }

    public function test(): void
    {
        $this->assertTrue(
            $this->model->is(
                ModelHelper::loadModelFromDatabase(
                    MyForm::class,
                    $this->model->id,
                ),
            ),
        );
    }
}
