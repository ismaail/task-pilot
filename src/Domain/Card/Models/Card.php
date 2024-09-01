<?php

namespace Domain\Card\Models;

use Domain\Timelog\Models\Timelog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;
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
        'spent_seconds',
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

    public function isCurrent(): bool
    {
        return Auth::user()->current_card_id === $this->id;
    }
}
