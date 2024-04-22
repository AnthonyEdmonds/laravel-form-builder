<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Forms;

use AnthonyEdmonds\LaravelFormBuilder\Forms\Form;

class TestForm extends Form
{
    public const string KEY = 'form';
    
    public const array ITEMS = [
        TestQuestion::class,
    ];
    
    protected function checkClass(): string
    {
        // TODO: Implement checkClass() method.
    }

    protected function resumeClass(): string
    {
        // TODO: Implement resumeClass() method.
    }
}
