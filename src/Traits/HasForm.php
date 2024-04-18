<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Traits;

use AnthonyEdmonds\LaravelFormBuilder\Form;

/**
 * @method static Form form()
 */
trait HasForm
{
    protected Form $form;

    abstract public static function formClass(): string;

    public function form(): Form
    {
        if (isset($this->form) === false) {
            $formClass = $this->formClass();
            $this->form = new $formClass($this);
        }

        return $this->form;
    }
}
