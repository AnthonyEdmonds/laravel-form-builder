<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Components;

use AnthonyEdmonds\LaravelFormBuilder\Components\Description;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;
use Illuminate\Contracts\View\View;

class DescriptionTest extends TestCase
{
    protected Description $component;

    protected View $view;

    protected function setUp(): void
    {
        parent::setUp();

        $this->component = new Description([]);
        $this->view = $this->component->render();
    }

    public function test(): void
    {
        $this->assertEquals(
            'form-builder::components.description',
            $this->view->name(),
        );
    }
}
