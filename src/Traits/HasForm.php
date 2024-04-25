<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Traits;

use AnthonyEdmonds\LaravelFormBuilder\Bases\Form;
use AnthonyEdmonds\LaravelFormBuilder\Exceptions\FormNotFoundException;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static Form form()
 * @mixin Model
 */
trait HasForm
{
    protected Form $form;

    // TODO
    protected ?string $formMode = null;

    // TODO
    protected ?string $currentFormItemKey = null;
    
    public function __call($method, $parameters)
    {
        if ($method === 'form') {
            return $this->newForm();
        }
        
        return parent::__call($method, $parameters);
    }

    public static function __callStatic($method, $parameters)
    {
        if ($method === 'form') {
            return static::staticNewForm();
        }
        
        return parent::__callStatic($method, $parameters);
    }

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
    
    public static function staticNewForm(): Form
    {
        $model = new static();
        return $model->form();
    }

    public function newForm(): Form
    {
        if (isset($this->form) === false) {
            $formClass = $this->formClass();
            $this->form = new $formClass($this);
        }

        return $this->form;
    }
}
