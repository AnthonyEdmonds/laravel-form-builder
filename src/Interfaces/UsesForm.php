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

    // Instantiation
    public static function makeForForm(): UsesForm;

    // Draft
    public function draftIsEnabled(): bool;

    public function draftIsValid(): true|string;

    public function saveAsDraft(): true|string;

    // Submit
    public function submitIsValid(): true|string;

    public function saveAndSubmit(): true|string;
}
