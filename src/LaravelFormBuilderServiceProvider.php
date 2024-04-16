<?php

namespace AnthonyEdmonds\LaravelFormBuilder;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class LaravelFormBuilderServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->publishes([
            __DIR__.'/form-builder.php' => config_path('form-builder.php'),
        ]);

        $this->mergeConfigFrom(
            __DIR__.'/form-builder.php',
            'form-builder',
        );
    }

    public function boot(): void
    {
        Route::macro('laravelFormBuilder', function () {
            Route::prefix('/forms/{formKey}/{mode?}/{keys?}')
                ->controller(FormController::class)
                ->name('form-builder.')
                ->group(function () {
                    Route::get('/', 'get')->where('keys', '.*')->name('get');
                    Route::post('/', 'post')->where('keys', '.*')->name('post');
                    Route::delete('/', 'delete')->where('keys', '.*')->name('delete');
                });
        });
    }
}
