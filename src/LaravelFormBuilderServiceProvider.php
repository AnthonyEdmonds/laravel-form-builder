<?php

namespace AnthonyEdmonds\LaravelFormBuilder;

use AnthonyEdmonds\LaravelFormBuilder\Controllers\ConfirmationController;
use AnthonyEdmonds\LaravelFormBuilder\Controllers\FormController;
use AnthonyEdmonds\LaravelFormBuilder\Controllers\QuestionController;
use AnthonyEdmonds\LaravelFormBuilder\Controllers\ResumeController;
use AnthonyEdmonds\LaravelFormBuilder\Controllers\StartController;
use AnthonyEdmonds\LaravelFormBuilder\Controllers\SummaryController;
use AnthonyEdmonds\LaravelFormBuilder\Controllers\TaskController;
use AnthonyEdmonds\LaravelFormBuilder\Controllers\TasksController;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

// TODO Update Readme to cover Fields
class LaravelFormBuilderServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/config.php', 'form-builder');
    }

    public function boot(): void
    {
        $this->config();
        $this->routes();
        $this->views();
        $this->components();
    }

    protected function components(): void
    {
        Blade::componentNamespace('AnthonyEdmonds\\LaravelFormBuilder\\Components', 'form-builder');
    }

    protected function config(): void
    {
        $this->publishes([
            __DIR__ . '/config.php' => config_path('form-builder.php'),
        ], 'config');
    }

    protected function routes(): void
    {
        Route::macro('laravelFormBuilder', function () {
            Route::prefix('/forms/{formKey}')
                ->name('forms.')
                ->group(function () {
                    Route::controller(FormController::class)->group(function () {
                        Route::post('/draft', 'draft')->name('draft');
                        Route::get('/edit/{modelKey}', 'edit')->name('edit');
                        Route::get('/exit', 'exit')->name('exit');
                        Route::get('/new', 'new')->name('new');
                        Route::post('/submit', 'submit')->name('submit');
                    });

                    Route::prefix('/resume')
                        ->name('resume.')
                        ->controller(ResumeController::class)
                        ->group(function () {
                            Route::get('/', 'show')->name('show');
                            Route::get('/restart', 'restart')->name('restart');
                        });

                    Route::prefix('/start')
                        ->name('start.')
                        ->controller(StartController::class)
                        ->group(function () {
                            Route::get('/', 'show')->name('show');
                        });

                    Route::prefix('/tasks')
                        ->name('tasks.')
                        ->controller(TasksController::class)
                        ->group(function () {
                            Route::get('/', 'show')->name('show');
                        });

                    Route::prefix('/task/{taskKey}')
                        ->name('task.')
                        ->controller(TaskController::class)
                        ->group(function () {
                            Route::get('/', 'show')->name('show');

                            Route::prefix('/{questionKey}')
                                ->name('questions.')
                                ->controller(QuestionController::class)
                                ->group(function () {
                                    Route::get('/', 'show')->name('show');
                                    Route::post('/save', 'save')->name('save');
                                    Route::post('/skip', 'skip')->name('skip');
                                });
                        });

                    Route::prefix('/summary')
                        ->name('summary.')
                        ->controller(SummaryController::class)
                        ->group(function () {
                            Route::get('/', 'show')->name('show');
                        });

                    Route::prefix('/confirmation')
                        ->name('confirmation.')
                        ->controller(ConfirmationController::class)
                        ->group(function () {
                            Route::get('/', 'show')->name('show');
                        });
                });
        });
    }

    protected function views(): void
    {
        $this->publishes([
            __DIR__ . '/Views' => resource_path('views/vendor/form-builder'),
        ], 'views');

        $this->loadViewsFrom(
            __DIR__ . '/Views',
            'form-builder',
        );
    }
}
