<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Interfaces;

use AnthonyEdmonds\LaravelFormBuilder\Bases\Form;
use Illuminate\Database\Eloquent\Model;

/**
 * Used in conjunction with the HasForm trait
 *
 * @method Form form()
 * @method static Form form()
 *
 * @mixin Model
 */
interface UsesForm
{
    public function __call($name, $arguments);

    public static function __callStatic($name, $arguments);

    public static function formClass(): string;

    public static function staticNewForm(): Form;

    public function newForm(): Form;
}
