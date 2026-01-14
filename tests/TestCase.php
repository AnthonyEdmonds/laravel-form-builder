<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests;

use AnthonyEdmonds\LaravelFormBuilder\Helpers\SessionHelper;
use AnthonyEdmonds\LaravelFormBuilder\LaravelFormBuilderServiceProvider;
use AnthonyEdmonds\LaravelFormBuilder\Traits\AssertsForms;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\MyForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\NonConfirmationForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\NonDraftForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Forms\NonStartForm;
use AnthonyEdmonds\LaravelFormBuilder\Tests\Models\MyModel;
use Illuminate\Support\Facades\Config;
use Orchestra\Testbench\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use AssertsForms;

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

    protected function startFormSession(?MyModel $model = null): MyModel
    {
        if ($model === null) {
            $model = new MyModel();
        }

        SessionHelper::setFormSession(MyForm::key(), $model);

        return $model;
    }

    protected function useForms(): void
    {
        Config::set('form-builder.forms', [
            MyForm::class,
            NonConfirmationForm::class,
            NonDraftForm::class,
            NonStartForm::class,
        ]);

        $router = app('router');
        $router->get('/')->name('/');
        $router->get('/{key}')->name('my-model.show');
        $router->laravelFormBuilder();
    }

    protected function useDatabase(): void
    {
        $this->app->useDatabasePath(__DIR__ . '/Database');
        $this->runLaravelMigrations();
    }
}
