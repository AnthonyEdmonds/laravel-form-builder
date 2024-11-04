# Laravel Form Builder

Create one-thing-per-page forms with forking logic and task lists; ideal for the GOV.UK Design System!

## What's in the box?

* Laravel 11 compatible classes for generating dynamic forms
* A complete start-to-finish form lifecycle
* Tasks to group questions into manageable chunks
* Forks to allow branching questions
* Session and database persisted models
* Support for looping, skipping, and drafting answers

## Installation

1. Install the library using Composer:
    ```bash
    composer require anthonyedmonds\laravel-form-builder
    ```
    * Laravel will automatically detect and register the Laravel Form Builder service provider.
2. Publish the config file:
   ```bash
   php artisan vendor:publish --provider="AnthonyEdmonds\LaravelFormBuilder\ServiceProviders\LaravelFormBuilderServiceProvider"
   ```
3. Create and configure a `Form` class, filling it with any number of `Task`, `Fork`, and `Question` classes.
4. Create a `Model` with the `HasForm` trait
5. Register the form in the `form-builder` config file:
   ```php
   'forms' => [
       RouteForm::class => RouteModel::class,
   ],
   ```
6. Add the form to your `web` routes:
    ```php
   Route::prefix('/admin/routes')
       ->group(function () {
           ...
           Route::laravelFormBuilder(RouteForm::class);
           ...
       });
    ```
   * Provide the fully qualified name of the Form class to the route helper
   * You can put the route helper wherever you want it, useful for structured route files
   * Add more forms by calling the route helper once for each Form
7. Access the form and away you go!
    ```php
    // Starting fresh...
    return MyModel::form()->start(); // RedirectResponse
   
    // From existing...
    return $myModel->form()->start(); // RedirectResponse
    ```
   
    ```html
    <!-- From blade... -->
    <a href="{{ $myModel->form()->startRoute() }}">Start form</a>
    ```

## Documentation

### Start

### Task

### Fork

### Question

### Summary

### Finish

## Contribution

Feel free to submit ideas and features as issues, and raise pull requests.
