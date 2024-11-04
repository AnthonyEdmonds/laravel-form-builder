<?php

namespace AnthonyEdmonds\LaravelFormBuilder\ServiceProviders;

use AnthonyEdmonds\LaravelFormBuilder\Controllers\FormController;
use AnthonyEdmonds\LaravelFormBuilder\Controllers\ItemController;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class LaravelFormBuilderServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../Config/form-builder.php', 'form-builder');
    }

    public function boot(): void
    {
        $this->bootPublishes();
        $this->bootRoutes();
        $this->bootViews();
    }

    protected function bootPublishes(): void
    {
        $this->publishes([
            __DIR__ . '/../Config/form-builder.php' => config_path('form-builder.php'),
        ], 'laravel-form-builder-config');

        $this->publishes([
            __DIR__ . '/../Views' => resource_path('views/vendor/laravel-form-builder'),
        ], 'laravel-form-builder-views');
    }

    public function bootRoutes(): void
    {
        Route::macro('laravelFormBuilder', function () {
            Route::prefix('/forms/{formKey}')
                ->controller(FormController::class)
                ->name('forms.')
                ->group(function () {
                    Route::prefix('/form')
                        ->group(function () {
                            Route::get('/start/{modelKey?}', 'start')->name('start');
                            Route::get('/fresh/{modelKey?}', 'fresh')->name('fresh');
                            Route::get('/resume', 'resume')->name('resume');
                            Route::get('/begin', 'begin')->name('begin');
                            Route::get('/check', 'check')->name('check');
                            Route::get('/save', 'save')->name('save');
                            Route::get('/submit', 'submit')->name('submit');
                            Route::get('/finish', 'finish')->name('finish');
                        });

                    Route::controller(ItemController::class)
                        ->prefix('/{path}')
                        ->name('items')
                        ->group(function () {
                            Route::get('/', 'show')->where('path', '.*');
                            Route::post('/', 'save')->where('path', '.*')->name('.save');
                            Route::post('/skip', 'skip')->where('path', '.*')->name('.skip');
                        });
                });
        });
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
