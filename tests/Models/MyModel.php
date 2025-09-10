<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Tests\Models;

use AnthonyEdmonds\LaravelFormBuilder\Interfaces\UsesForm;
use AnthonyEdmonds\LaravelFormBuilder\Traits\HasForm;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 */
class MyModel extends Model implements UsesForm
{
    use HasForm;

    protected $fillable = [];

    protected $guarded = [
        'id',
    ];

    protected $casts = [
        'id' => 'int',
    ];

    // UsesForm
    public function viewRoute(): string
    {
        return route('my-model.show', $this);
    }
}
