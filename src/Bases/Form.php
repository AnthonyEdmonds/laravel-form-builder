<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Bases;

use AnthonyEdmonds\LaravelFormBuilder\Exceptions\FormNotFoundException;
use AnthonyEdmonds\LaravelFormBuilder\Traits\HasForm;
use Illuminate\Database\Eloquent\Model;

abstract class Form
{
    /** The unique key this Form is known by */
    abstract public static function key(): string;

    /**
     * The registered Model for this Form
     * @return class-string<Model|\AnthonyEdmonds\LaravelFormBuilder\Traits\HasForm>
     */
    public static function modelClass(): string
    {
        $forms = config('form-builder.forms');
        $formClass = self::class;

        return array_key_exists($formClass, $forms) === false
            ? throw new FormNotFoundException("No model has been registered for \"$formClass\"")
            : $forms[$formClass];
    }
}
