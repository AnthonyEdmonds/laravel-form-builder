<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Components;

use AnthonyEdmonds\LaravelFormBuilder\Components\Breadcrumbs;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;
use Illuminate\Contracts\View\View;

class BreadcrumbsTest extends TestCase
{
    protected Breadcrumbs $component;

    protected View $view;

    protected function setUp(): void
    {
        parent::setUp();

        $this->component = new Breadcrumbs([]);
        $this->view = $this->component->render();
    }

    public function test(): void
    {
        $this->assertEquals(
            'form-builder::components.breadcrumbs',
            $this->view->name(),
        );
    }
}
