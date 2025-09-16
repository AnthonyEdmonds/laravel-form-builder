<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Models;

use AnthonyEdmonds\LaravelFormBuilder\Interfaces\UsesForm;
use AnthonyEdmonds\LaravelFormBuilder\Traits\HasForm;
use Illuminate\Database\Eloquent\Model;

/**
 * @property bool $draft_is_valid
 * @property int $id
 * @property bool $submit_is_valid
 */
class MyModel extends Model implements UsesForm
{
    use HasForm;

    protected $fillable = [
        'draft_is_valid',
        'submit_is_valid',
    ];

    protected $guarded = [
        'id',
    ];

    protected $casts = [
        'draft_is_valid' => 'bool',
        'id' => 'int',
        'submit_is_valid' => 'bool',
    ];

    // UsesForm
    public function draftIsValid(): true|string
    {
        return $this->draft_is_valid === true
            ? true
            : 'Draft is not valid';
    }

    public function submitIsValid(): true|string
    {
        return $this->submit_is_valid === true
            ? true
            : 'Submit is not valid';
    }

    public function viewRoute(): string
    {
        return route('my-model.show', $this);
    }
}
