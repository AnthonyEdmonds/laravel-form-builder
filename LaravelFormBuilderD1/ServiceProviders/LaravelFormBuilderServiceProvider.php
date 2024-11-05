<?php

namespace AnthonyEdmonds\LaravelFormBuilder\ServiceProviders;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class LaravelFormBuilderServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->bootPublishes();
        $this->bootViews();
    }

    protected function bootPublishes(): void
    {
        $this->publishes([
            __DIR__ . '/../Views' => resource_path('views/vendor/laravel-form-builder'),
        ], 'laravel-form-builder-views');
    }

    protected function bootViews(): void
    {
        Blade::componentNamespace('AnthonyEdmonds\\LaravelFormBuilder\\Components', 'form-builder-ui');
        Blade::componentNamespace('AnthonyEdmonds\\LaravelFormBuilder\\Inputs', 'form-builder');

        $this->loadViewsFrom(
            __DIR__ . '/../Views',
            'form-builder',
        );
    }
}
