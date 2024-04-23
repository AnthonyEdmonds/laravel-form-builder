<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Traits;

use AnthonyEdmonds\LaravelFormBuilder\Bases\Form;
use Anthonyedmonds\LaravelFormBuilder\Exceptions\FormNotFoundException;

/**
 * @method static Form form()
 */
trait HasForm
{
    protected Form $form;

    protected ?string $formMode = null;

    protected ?string $currentFormItemKey = null;

    /** @return class-string<Form> */
    public static function formClass(): string
    {
        $modelClass = static::class;
        $forms = config('form-builder.forms', []);
        $formClass = array_search($modelClass, $forms);

        if ($formClass === false) {
            throw new FormNotFoundException("No form has been registered for \"$modelClass\"");
        }

        return $formClass;
    }

    public function form(): Form
    {
        if (isset($this->form) === false) {
            $formClass = $this->formClass();
            $this->form = new $formClass($this);
        }

        return $this->form;
    }
}
