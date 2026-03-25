<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Traits\HasForm\Answers;

use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;
use stdClass;

class GetAnswerFromRelationTest extends TestCase
{
    protected MyModel $model;

    protected function setUp(): void
    {
        parent::setUp();

        $this->model = new MyModel();
    }

    public function testModelWithRelationship(): void
    {
        $relation = new MyModel();
        $relation->name = 'Hello there';

        $this->model->setRelations([
            'parent' => $relation,
        ]);

        $this->assertEquals(
            'Hello there',
            $this->model->formattedAnswer('parent.name'),
        );
    }

    public function testModelWithObject(): void
    {
        $this->model->potato = new stdClass();
        $this->model->potato->squish = 'Hello there';

        $this->assertEquals(
            'Hello there',
            $this->model->formattedAnswer('potato.squish'),
        );
    }

    public function testModelWithArray(): void
    {
        $this->model->potato = [
            'squish' => 'Hello there',
        ];

        $this->assertEquals(
            'Hello there',
            $this->model->formattedAnswer('potato.squish'),
        );
    }

    public function testMissing(): void
    {
        $this->assertEquals(
            $this->model->blankAnswer('potato'),
            $this->model->formattedAnswer('potato.squish'),
        );
    }
}
