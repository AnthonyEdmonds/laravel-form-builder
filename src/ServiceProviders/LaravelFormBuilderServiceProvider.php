<?php

namespace AnthonyEdmonds\LaravelFormBuilder\ServiceProviders;

use AnthonyEdmonds\LaravelFormBuilder\Controllers\FormController;
use AnthonyEdmonds\LaravelFormBuilder\Controllers\ItemController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class LaravelFormBuilderServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->publishes([
            __DIR__.'/../Config/form-builder.php' => config_path('form-builder.php'),
        ]);

        $this->mergeConfigFrom(__DIR__.'/../Config/form-builder.php', 'form-builder');
    }

    public function boot(): void
    {
        Route::macro('laravelFormBuilder', function () {
            Route::prefix('/forms/{formKey}')
                ->controller(FormController::class)
                ->name('form-builder.')
                ->group(function () {
                    Route::get('/start/{modelKey?}', 'start')->name('start');
                    Route::get('/fresh/{modelKey?}', 'fresh')->name('fresh');
                    Route::get('/resume', 'resume')->name('resume');
                    Route::get('/begin', 'begin')->name('begin');
                    Route::post('/save', 'save')->name('save');
                    Route::get('/check', 'check')->name('check');
                    Route::post('/submit', 'submit')->name('submit');
                    Route::get('/finish', 'finish')->name('finish');
                    Route::get('/exit', 'exit')->name('exit');

                    Route::controller(ItemController::class)
                        ->prefix('/{keys}')
                        ->name('item')
                        ->group(function () {
                            Route::get('/', 'show')->where('keys', '.*');
                            Route::post('/', 'save')->where('keys', '.*')->name('.save');
                            Route::put('/', 'skip')->where('keys', '.*')->name('.skip');
                            Route::delete('/', 'delete')->where('keys', '.*')->name('.delete');
                        });
                });
        });
    }
}
