<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Interfaces;

use AnthonyEdmonds\LaravelFormBuilder\Items\Form;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;

/**
 * Used in conjunction with the HasForm trait
 * @mixin Model
 */
interface UsesForm
{
    // Form
    public static function formClass(): string;

    public static function formRoute(Model|string|int|null $id = null): string;

    public static function newForm(): Form;

    public function form(): Form;

    public function view(?string $blade = null): View;

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

    // Answers
    public function blankAnswer(string $property): string;

    public function formattedAnswer(string $property): mixed;

    public function hasAnswer(string $property): bool;

    public function rawAnswer(string $property): mixed;
}
