<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Helpers\Session;

use AnthonyEdmonds\LaravelFormBuilder\Helpers\SessionHelper;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;
use Illuminate\Support\Facades\Session;

class SetFormSessionTest extends TestCase
{
    protected string $formKey;

    protected function setUp(): void
    {
        parent::setUp();

        $this->formKey = MyForm::key();

        SessionHelper::setFormSession($this->formKey, new MyModel());
    }

    public function test(): void
    {
        $this->assertTrue(
            Session::has($this->formKey),
        );
    }
}
