<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Traits;

use AnthonyEdmonds\LaravelFormBuilder\Bases\Form;
use AnthonyEdmonds\LaravelFormBuilder\Exceptions\FormNotFoundException;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $currentMode
 * @property string $currentPath
 * @property Form $form
 *
 * @method Form form()
 * @method static Form form()
 *
 * @mixin Model
 */
trait HasForm
{
    /** Mode of the current Form session */
    protected string $currentMode = Form::NEW;

    /** Path to the Item the User last accessed in the current Form session */
    protected string $currentPath = Form::START;

    /** Cache of the Form */
    protected Form $form;

    // Setup
    /**
     * @param string $method
     * @param array $parameters
     * @return Form|mixed
     */
    public function __call($method, $parameters)
    {
        return $method === 'form'
            ? $this->newForm()
            : parent::__call($method, $parameters);
    }

    /**
     * @param string $method
     * @param array $parameters
     * @return Form|mixed
     */
    public static function __callStatic($method, $parameters)
    {
        return $method === 'form'
            ? static::staticNewForm()
            : parent::__callStatic($method, $parameters);
    }

    /**
     * @param string $key
     * @return Form|mixed
     */
    public function __get($key)
    {
        return match ($key) {
            'currentMode' => $this->currentMode,
            'currentPath' => $this->currentPath,
            'form' => $this->form,
            default => parent::__get($key),
        };
    }

    // Form Class
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

    protected static function staticNewForm(): Form
    {
        $model = new static();
        return $model->form();
    }

    protected function newForm(): Form
    {
        if (isset($this->form) === false) {
            $formClass = $this->formClass();
            $this->form = new $formClass($this);
        }

        return $this->form;
    }

    // Setters
    /** Set the Form mode */
    public function setCurrentMode(string $mode): static
    {
        $this->currentMode = $mode;
        return $this;
    }

    /** Set the path to the current Form Item */
    public function setCurrentPath(string $path): static
    {
        $this->currentPath = $path;
        return $this;
    }

    // Utilities
    /** @return true|string True, or why this Model cannot be saved */
    public function canSave(): true|string
    {
        return true;
    }

    /** @return true|string True, or why this Model cannot be submitted */
    public function canSubmit(): true|string
    {
        return true;
    }
}
