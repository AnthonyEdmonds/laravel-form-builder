<?php

namespace AnthonyEdmonds\LaravelFormBuilder\ServiceProviders;

use AnthonyEdmonds\LaravelFormBuilder\Controllers\FormController;
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
                    Route::get('/resume', 'resume')->name('resume');
                    Route::get('/begin', 'begin')->name('begin');
                    
                    // TODO Items
                    
                    Route::post('/save', 'save')->name('save');
                    Route::post('/submit', 'submit')->name('submit');
                    Route::get('/finish', 'finish')->name('finish');
                    Route::get('/exit', 'exit')->name('exit');
                    
                    // TODO Turn into items parsing
                    Route::prefix('/{mode?}/{keys?}')->group(function () {
                        Route::get('/', 'get')->where('keys', '.*')->name('get');
                        Route::post('/', 'post')->where('keys', '.*')->name('post');
                        Route::delete('/', 'delete')->where('keys', '.*')->name('delete');
                    });
                });
        });
    }
}
