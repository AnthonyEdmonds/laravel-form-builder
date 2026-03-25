<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Models;

use AnthonyEdmonds\LaravelFormBuilder\Interfaces\UsesForm;
use AnthonyEdmonds\LaravelFormBuilder\Traits\HasForm;
use Carbon\Carbon;
use ErrorException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property ?int $age
 * @property bool $age_not_required
 * @property ?Carbon $birthday
 * @property bool $can_access
 * @property bool $cannot_start
 * @property ?string $colour
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
        'age_not_required',
        'birthday',
        'can_access',
        'colour',
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
        'age_not_required' => 'bool',
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

    // Getters
    public function getColourAttribute(): ?string
    {
        return $this->attributes['colour'] === 'invalid'
            ? throw new ErrorException('Bad implementation')
            : $this->attributes['colour'];
    }

    // Relationships
    public function parent(): BelongsTo
    {
        return $this->belongsTo(MyModel::class);
    }

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
