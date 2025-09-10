<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Components;

use AnthonyEdmonds\LaravelFormBuilder\Components\Actions;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;
use Illuminate\Contracts\View\View;

class ActionsTest extends TestCase
{
    protected Actions $component;

    protected View $view;

    protected function setUp(): void
    {
        parent::setUp();

        $this->component = new Actions([]);
        $this->view = $this->component->render();
    }

    public function test(): void
    {
        $this->assertEquals(
            'form-builder::components.actions',
            $this->view->name(),
        );
    }
}
