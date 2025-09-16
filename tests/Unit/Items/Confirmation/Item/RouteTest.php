<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Items\Confirmation\Item;

use AnthonyEdmonds\LaravelFormBuilder\Items\Confirmation;
use AnthonyEdmonds\LaravelFormBuilder\Items\Form;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;

class RouteTest extends TestCase
{
    protected Confirmation $confirmation;

    protected Form $form;

    protected function setUp(): void
    {
        parent::setUp();

        $this->form = new MyForm(
            new MyModel(),
        );

        $this->confirmation = new Confirmation($this->form);
    }

    public function test(): void
    {
        $this->assertEquals(
            route('forms.confirmation.show', $this->form->key),
            $this->confirmation->route(),
        );
    }
}
