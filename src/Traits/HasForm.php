<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Traits;

use AnthonyEdmonds\LaravelFormBuilder\Bases\Form;
use Illuminate\Database\Eloquent\Model;

/**
 * Used in conjunction with the UsesForm interface
 *
 * @method Form form()
 * @method static Form form()
 *
 * @mixin Model
 */
trait HasForm
{
    protected Form $form;

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
        return Form::formClassByModel(static::class);
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
