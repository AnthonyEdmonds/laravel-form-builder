<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests;

use AnthonyEdmonds\LaravelFormBuilder\Helpers\SessionHelper;
use AnthonyEdmonds\LaravelFormBuilder\LaravelFormBuilderServiceProvider;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use Illuminate\Support\Facades\Config;
use Orchestra\Testbench\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->useForms();
    }

    protected function getPackageProviders($app): array
    {
        return [
            LaravelFormBuilderServiceProvider::class,
        ];
    }

    protected function startFormSession(): MyModel
    {
        $model = new MyModel();

        SessionHelper::setFormSession(MyForm::key(), $model);

        return $model;
    }

    protected function useForms(): void
    {
        Config::set('form-builder.forms', [
            MyForm::class,
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
