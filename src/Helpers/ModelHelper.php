<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Helpers;

use AnthonyEdmonds\LaravelFormBuilder\Interfaces\UsesForm;
use AnthonyEdmonds\LaravelFormBuilder\Items\Form;

class ModelHelper
{
    /** @param class-string<Form> $formClass */
    public static function loadModelFromDatabase(string $formClass, string $modelKey): UsesForm
    {
        /** @var class-string<UsesForm> $modelClass */
        $modelClass = $formClass::modelClass();

        /** @var UsesForm $model */
        $model = $modelClass::query()->findOrFail($modelKey);

        return $model;
    }

    /** @param class-string<Form> $formClass */
    public static function newModel(string $formClass): UsesForm
    {
        /** @var class-string<UsesForm> $modelClass */
        $modelClass = $formClass::modelClass();

        return $modelClass::makeForForm();
    }
}
