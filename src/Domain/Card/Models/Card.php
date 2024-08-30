<?php

namespace Domain\Card\Models;

use Illuminate\Database\Eloquent\Model;
use Support\Models\Concerns\HasFactory;

/**
 * @mixin IdeHelperCard
 */
class Card extends Model
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
