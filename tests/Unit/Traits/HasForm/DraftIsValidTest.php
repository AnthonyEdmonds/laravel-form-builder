<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Traits\HasForm;

use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\BasicModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class DraftIsValidTest extends TestCase
{
    protected BasicModel $model;

    protected function setUp(): void
    {
        parent::setUp();

        $this->model = new BasicModel();
        $this->model->draft_is_valid = true;
    }

    public function test(): void
    {
        $this->assertTrue(
            $this->model->draftIsValid(),
        );
    }
}
