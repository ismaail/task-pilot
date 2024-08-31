<?php

namespace Domain\Card\Models;

use Domain\Timelog\Models\Timelog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
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

    public function timelogs(): HasMany
    {
        return $this->hasMany(Timelog::class, 'card_id', 'id');
    }
}
