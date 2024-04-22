<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Forms;

use Anthonyedmonds\LaravelFormBuilder\Exceptions\FormNotFoundException;
use AnthonyEdmonds\LaravelFormBuilder\Items\Item;
use AnthonyEdmonds\LaravelFormBuilder\Screens\Begin;
use AnthonyEdmonds\LaravelFormBuilder\Screens\Check;
use AnthonyEdmonds\LaravelFormBuilder\Screens\Finish;
use AnthonyEdmonds\LaravelFormBuilder\Screens\Resume;
use AnthonyEdmonds\LaravelFormBuilder\Traits\HasForm;
use AnthonyEdmonds\LaravelFormBuilder\Traits\HasItems;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;

abstract class Form
{
    use HasItems;
    
    // Constants
    public const string EDIT = 'edit';
    
    public const string NEW = 'new';

    public const string REVIEW = 'review';

    public const array MODES = [
        self::EDIT,
        self::NEW,
        self::REVIEW,
    ];

    // Attributes
    protected bool $canSave = false;
    
    protected Model $model;
    
    // Setup
    public function __construct(Model $model)
    {
        $this->model = $model;
    }
    
    // Actions
    public static function new(string $formKey, ?string $modelKey = null): Form
    {
        $formClass = Form::formClassByKey($formKey);
        $modelClass = $formClass::modelClass();

        $model = $modelKey !== null
            ? $modelClass::findOrFail($modelKey)
            : new $modelClass();
        
        return $model->form();
    }
    
    public function begin(): View
    {
        $beginClass = $this->beginClass();
        return new $beginClass($this, $this->model);
    }

    public function check(): View
    {
        $checkClass = $this->checkClass();
        return new $checkClass($this, $this->model);
    }
    
    public function exit(): RedirectResponse
    {
        Session::forget(static::KEY);
        return redirect($this->exitRoute());
    }
    
    public function finish(): View
    {
        $finishClass = $this->finishClass();
        return new $finishClass($this, $this->model);
    }
    
    public function resume(): View
    {
        $resumeClass = $this->resumeClass();
        return new $resumeClass($this, $this->model);
    }
    
    public function save(): RedirectResponse
    {
        return $this->submit();
    }
    
    public function start(): RedirectResponse
    {
        if (Session::has(static::KEY) === true) {
            $route = $this->resumeRoute();
            
        } else {
            Session::put(static::KEY, $this->model);

            $route = $this->model->exists === true
                ? $this->checkRoute()
                : $this->startRoute();
        }
        
        return redirect($route);
    }
    
    public function submit(): RedirectResponse
    {
        $this->model->save();
        Session::flash(static::KEY, $this->model);
        
        return redirect($this->finishRoute());
    }
    
    // Object Class Names
    // TODO Default screen
    /** @return class-string<Check> */
    abstract protected function checkClass(): string;

    // TODO Default screen
    /** @return class-string<Resume> */
    abstract protected function resumeClass(): string;
    
    /** @return ?class-string<Begin> */
    protected function beginClass(): string|null
    {
        return null;
    }

    /** @return ?class-string<Finish> */
    protected function finishClass(): string|null
    {
        return null;
    }
    
    /** @return class-string<self> */
    protected static function formClassByKey(string $key): string
    {
        $forms = config('form-builder.forms', []);

        /**
         * @var Form $formClass
         * @var Model|HasForm $modelClass
         */
        foreach ($forms as $formClass => $modelClass) {
            if ($formClass::KEY === $key) {
                return $formClass;
            }
        }

        throw new FormNotFoundException("The \"$key\" form has not been registered");
    }

    /** @return class-string<Model|HasForm> */
    protected static function modelClass(): string
    {
        $key = static::KEY;
        $forms = config('form-builder.forms', []);

        if (array_key_exists($key, $forms) === false) {
            throw new FormNotFoundException("The \"$key\" form has not been registered");
        }
        
        return $forms[$key];
    }
    
    // Routing
    protected function beginRoute(): string
    {
        $beginClass = $this->beginClass();

        return $beginClass !== null
            ? route('form-builder.begin', [static::KEY, $beginClass::KEY])
            : $this->exitRoute(); // TODO First question / item
    }
    
    protected function checkRoute(): string
    {
        return route('form-builder.check', [static::KEY, $this->checkClass()::KEY]);
    }

    protected function exitRoute(): string
    {
        return route('dashboard');
    }
    
    protected function finishRoute(): string
    {
        $finishClass = $this->finishClass();
        
        return $finishClass !== null
            ? route('form-builder.finish', [static::KEY, $finishClass::KEY])
            : $this->exitRoute();
    }
    
    protected function itemRoute(string $itemKey): string
    {
        // TODO traverse items to get url keys
        $keys = '';
        return route('form-builder.item', [static::KEY, $keys]);
    }

    protected function nextRoute(): string
    {
        // TODO traverse items to find next
        // Could be within item, fork, task, or to a screen
        return '';
    }
    
    protected function previousRoute(): string
    {
        // TODO traverse items to find previous
        // Could be within item, fork, task, or to a screen
        return '';
    }
    
    protected function resumeRoute(): string
    {
        return route('form-builder.check', [static::KEY, $this->resumeClass()::KEY]);
    }
    
    protected function saveRoute(): string
    {
        return $this->canSave === true
            ? route('form-builder.save', static::KEY)
            : $this->submitRoute();
    }
    
    protected function startRoute(): string
    {
        return route('form-builder.start', [static::KEY, $this->model]);
    }
    
    protected function submitRoute(): string
    {
        return route('form-builder.submit', static::KEY);
    }
}

/*
    public function parseRoute(array $route): Question
    {
        $currentKey = array_pop($route);

        foreach ($this->questions as $question) {
            if ($currentKey === $question::KEY) {
                ** @var FormItem $item *
                $item = new $question($this);

                return is_a($item, Question::class) !== true
                    ? $item->parseRoute($route)
                    : $item;
            }
        }
    }

    public function previousRoute(): string
    {
        // If first key in parent, call parent previous
    }
 */
