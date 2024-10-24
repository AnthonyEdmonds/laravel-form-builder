<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Bases;

use AnthonyEdmonds\LaravelFormBuilder\Traits\HasForm;
use AnthonyEdmonds\LaravelFormBuilder\Traits\HasKey;
use AnthonyEdmonds\LaravelFormBuilder\Traits\Renderable;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;

abstract class Item implements View
{
    use HasKey;
    use Renderable;

    /** The Form this Item belongs to */
    public readonly Form $form;

    /**
     * @var Model|HasForm $model The Model this Item is related to
     * @noinspection PhpDocFieldTypeMismatchInspection
     */
    public readonly Model $model;

    // Setup
    public function __construct(Form $form, Model $model) {
        $this->form = $form;
        $this->model = $model;
    }

    /** @return array<string, Form|Model|array<string, string>> This Item's parts */
    public function toArray(): array
    {
        return [
            'form' => $this->form,
            'links' => $this->links(),
            'model' => $this->model,
        ];
    }

    // Routing
    /** @return array<string, ?string> Links to navigate back, here, and next */
    public function links(): array
    {
        return [
            'action' => $this->actionRoute(),
            'back' => $this->backRoute(),
            'exit' => $this->form->exitRoute(),
            'next' => $this->nextRoute(),
            'other' => $this->otherRoute(),
        ];
    }

    /** Link to the "main" action of the Item, such as submit */
    public function actionRoute(): ?string
    {
        return null;
    }

    /** Link to the previous Item, Screen, or exit */
    public function backRoute(): string
    {
        if ($this->form->firstItemPath() === $this->model->currentPath) {
            return $this->form->beginScreen() !== null
                ? $this->form->beginRoute()
                : $this->form->exitRoute();
        }
        
        return $this->form->itemRoute($this->form->previousItemPath($this->model->currentPath));
    }

    /** Link to the next Item, Screen, or exit */
    public function nextRoute(): string
    {
        return $this->form->lastItemPath() === $this->model->currentPath
            ? $this->form->checkRoute()
            : $this->form->itemRoute($this->form->nextItemPath($this->model->currentPath));
    }

    /** Link to the "other" action of the Item, such as skip */
    public function otherRoute(): ?string
    {
        return null;
    }
}
