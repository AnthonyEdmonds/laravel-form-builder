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
   php artisan vendor:publish --provider="AnthonyEdmonds\LaravelFormBuilder\LaravelFormBuilderServiceProvider"
   ```
3. Add the form routes to your `web.php` routes file:
    ```php
    Route::laravelFormBuilder();
    ```
4. Create and configure a `Form` class, filling it with any number of `Task`, `Fork`, and `Question` classes.
5. Create a `Model` with the `HasForm` trait
6. Access the form and away you go!
    ```php
    // Starting fresh...
    MyModel::form()->start();
   
    // From existing...
    $myModel->form()->start();
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
