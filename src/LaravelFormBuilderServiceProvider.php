<?php

namespace AnthonyEdmonds\LaravelFormBuilder;

use AnthonyEdmonds\LaravelFormBuilder\Controllers\FormController;
use AnthonyEdmonds\LaravelFormBuilder\Controllers\QuestionController;
use AnthonyEdmonds\LaravelFormBuilder\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class LaravelFormBuilderServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->publishes([
            __DIR__ . '/form-builder.php' => config_path('form-builder.php'),
        ], 'config');

        $this->mergeConfigFrom(__DIR__ . '/form-builder.php', 'form-builder');
    }

    public function boot(): void
    {
        Route::macro('laravelFormBuilder', function () {
            Route::prefix('/{formKey}')
                ->name('form.')
                ->controller(FormController::class)
                ->group(function () {
                    Route::get('/start/{modelKey?}', 'start')->name('start');
                    Route::get('/fresh/{modelKey?}', 'fresh')->name('fresh');
                    Route::get('/resume', 'resume')->name('resume');
                    Route::get('/begin', 'begin')->name('begin');
                    Route::get('/check', 'check')->name('check');
                    Route::get('/save', 'save')->name('save');
                    Route::get('/submit', 'submit')->name('submit');
                    Route::get('/finish', 'finish')->name('finish');
                    Route::get('/exit', 'exit')->name('exit');

                    Route::prefix('/{taskKey}')
                        ->name('task.')
                        ->controller(TaskController::class)
                        ->group(function () {
                            Route::get('/', 'show')->name('show');

                            Route::prefix('/{questionKey}')
                                ->name('question.')
                                ->controller(QuestionController::class)
                                ->group(function () {
                                    Route::get('/', 'show')->where('keys', '.*')->name('show');
                                    Route::post('/', 'save')->where('keys', '.*')->name('save');
                                    Route::put('/', 'skip')->where('keys', '.*')->name('skip');
                                });
                        });
                });
        });
    }
}
