<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Components;

use AnthonyEdmonds\LaravelFormBuilder\Components\Field;
use AnthonyEdmonds\LaravelFormBuilder\Helpers\Field as FieldHelper;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;
use Illuminate\Contracts\View\View;

class FieldTest extends TestCase
{
    protected Field $component;

    protected View $view;

    protected function setUp(): void
    {
        parent::setUp();

        $this->component = new Field(
            FieldHelper::input('name', 'label'),
        );
        $this->view = $this->component->render();
    }

    public function test(): void
    {
        $this->assertEquals(
            'form-builder::components.field',
            $this->view->name(),
        );
    }
}
