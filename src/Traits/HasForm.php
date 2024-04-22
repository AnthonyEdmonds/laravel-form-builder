<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Traits;

use Anthonyedmonds\LaravelFormBuilder\Exceptions\FormNotFoundException;
use AnthonyEdmonds\LaravelFormBuilder\Forms\Form;

/**
 * @method static Form form()
 */
trait HasForm
{
    // TODO Use property which would be serialised for mode, instead of passing in url
    // TODO Track last item key?
    
    protected Form $form;

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
