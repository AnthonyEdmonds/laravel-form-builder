<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Models;

use AnthonyEdmonds\LaravelFormBuilder\Interfaces\UsesForm;
use AnthonyEdmonds\LaravelFormBuilder\Traits\HasForm;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property ?int $age
 * @property ?Carbon $birthday
 * @property bool $can_access
 * @property bool $cannot_start
 * @property bool $draft_is_valid
 * @property int $id
 * @property ?string $name
 * @property bool $not_required
 * @property bool $submit_is_valid
 */
class MyModel extends Model implements UsesForm
{
    use HasForm;

    protected $fillable = [
        'age',
        'birthday',
        'can_access',
        'draft_is_valid',
        'name',
        'not_required',
        'submit_is_valid',
    ];

    protected $guarded = [
        'id',
    ];

    protected $casts = [
        'age' => 'int',
        'birthday' => 'datetime',
        'can_access' => 'bool',
        'cannot_start' => 'bool',
        'draft_is_valid' => 'bool',
        'id' => 'int',
        'not_required' => 'bool',
        'submit_is_valid' => 'bool',
    ];

    protected $attributes = [
        'can_access' => true,
    ];

    // UsesForm
    public function draftIsValid(): true|string
    {
        return $this->draft_is_valid === true
            ? true
            : 'Draft is not valid';
    }

    public function viewRoute(): string
    {
        return route('my-model.show', $this);
    }
}
