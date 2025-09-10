<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Unit\Helpers\Session;

use AnthonyEdmonds\LaravelFormBuilder\Helpers\SessionHelper;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\TestCase;
use Illuminate\Support\Facades\Session;

class FormHasSessionTest extends TestCase
{
    protected string $formKey;

    protected function setUp(): void
    {
        parent::setUp();

        $this->formKey = MyForm::key();
        Session::put($this->formKey, 1);
    }

    public function test(): void
    {
        $this->assertTrue(
            SessionHelper::formHasSession($this->formKey),
        );
    }
}
