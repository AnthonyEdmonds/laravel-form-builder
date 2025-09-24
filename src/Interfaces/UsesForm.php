<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Interfaces;

use AnthonyEdmonds\LaravelFormBuilder\Items\Form;
use Illuminate\Database\Eloquent\Model;

/**
 * Used in conjunction with the HasForm trait
 * @mixin Model
 */
interface UsesForm
{
    // Form
    public static function formClass(): string;

    public static function newForm(): Form;

    public function form(): Form;

    public function viewRoute(): string;

    public function viewLabel(): string;

    public function modelName(): string;

    // Instantiation
    public static function makeForForm(): UsesForm;

    // Draft
    public function draftIsEnabled(): bool;

    public function draftIsValid(): true|string;

    public function saveAsDraft(): void;

    // Submit
    public function submitIsValid(): true|string;

    public function saveAndSubmit(): void;
}
