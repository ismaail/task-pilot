<?php

declare(strict_types=1);

namespace Domain\Card\Models;

use Domain\Timelog\Models\Timelog;
use Domain\Timelog\ValueObject\ElapsedTime;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Support\Models\Concerns\HasFactory;

/**
 * @mixin IdeHelperCard
 */
class Card extends Model implements Sortable
{
    use HasFactory;
    use SortableTrait;

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

    public function elapsedTime(): Attribute
    {
        return Attribute::make(
            get: fn () => ElapsedTime::fromSeconds($this->spent_seconds),
        );
    }
}
