<?php

namespace AnthonyEdmonds\LaravelFormBuilder;

use AnthonyEdmonds\LaravelFormBuilder\Bases\Form;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class LaravelFormBuilderServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->publishes([
            __DIR__ . '/form-builder.php' => config_path('form-builder.php'),
        ]);

        $this->mergeConfigFrom(__DIR__ . '/form-builder.php', 'form-builder');
    }

    public function boot(): void
    {
        Route::macro('laravelFormBuilder', function (string $formClass) {
            /** @var class-string<Form> $formClass */
            $key = $formClass::key();

            Route::prefix("/form/$key")
                ->controller(Controller::class)
                ->name('form-builder.')
                ->group(function () {});
        });
    }
}
