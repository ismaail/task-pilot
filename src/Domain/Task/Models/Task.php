<?php

namespace Domain\Task\Models;

use Illuminate\Database\Eloquent\Model;
use Support\Models\Concerns\HasFactory;

/**
 * @mixin IdeHelperTask
 */
class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'sort',
    ];

    protected function casts(): array
    {
        return [
            'completed' => 'boolean',
            'archived' => 'boolean',
        ];
    }
}
