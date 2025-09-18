<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Models;

use AnthonyEdmonds\LaravelFormBuilder\Interfaces\UsesForm;
use AnthonyEdmonds\LaravelFormBuilder\Traits\HasForm;
use Illuminate\Database\Eloquent\Model;

/**
 * @property bool $draft_is_valid
 * @property bool $submit_is_valid
 */
class BasicModel extends Model implements UsesForm
{
    use HasForm;

    protected $fillable = [
        'draft_is_valid',
        'submit_is_valid',
    ];

    protected $casts = [
        'draft_is_valid' => 'bool',
        'submit_is_valid' => 'bool',
    ];

    // UsesForm
    public function viewRoute(): string
    {
        return route('my-model.show', $this);
    }
}
