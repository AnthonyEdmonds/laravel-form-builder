<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Screens;

use AnthonyEdmonds\LaravelFormBuilder\Bases\Screen;

class Resume extends Screen
{
    public static function key(): string
    {
        return 'resume';
    }

    public function name(): string
    {
        return 'form-builder::screens.resume';
    }

    public function actionRoute(): ?string
    {
        return $this->form->itemRoute($this->model->currentPath);
    }

    public function otherRoute(): ?string
    {
        return $this->form->freshRoute();
    }
}
