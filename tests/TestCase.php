<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests;

use AnthonyEdmonds\LaravelFormBuilder\ServiceProviders\LaravelFormBuilderServiceProvider;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\TestForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\TestUser;
use Illuminate\Support\Facades\Config;
use Orchestra\Testbench\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app): array
    {
        return [
            LaravelFormBuilderServiceProvider::class,
        ];
    }

    protected function useForms(): void
    {
        Config::set('form-builder.forms', [
            TestForm::class => TestUser::class, 0,
        ]);

        $router = app('router');
        $router->get('/')->name('/');
        $router->laravelFormBuilder();
    }

    protected function useDatabase(): void
    {
        $this->app->useDatabasePath(__DIR__ . '/Database');
        $this->runLaravelMigrations();
    }
}
