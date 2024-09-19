<?php

declare(strict_types=1);

namespace Domain\Card\Models;

use Domain\Bucket\Models\Bucket;
use Domain\Timelog\Models\Timelog;
use Domain\Timelog\ValueObject\ElapsedTime;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'completed' => 'boolean',
            'archived' => 'boolean',
        ];
    }

    /**
     * @return BelongsTo<Bucket, Card>
     */
    public function bucket(): BelongsTo
    {
        return $this->belongsTo(Bucket::class, 'bucket_id', 'id');
    }

    /**
     * @return HasMany<Timelog>
     */
    public function timelogs(): HasMany
    {
        return $this->hasMany(Timelog::class, 'card_id', 'id');
    }

    public function isCurrent(): bool
    {
        return Auth::user()->current_card_id === $this->id;
    }

    /**
     * @return Attribute<ElapsedTime, null>
     */
    public function elapsedTime(): Attribute
    {
        return Attribute::make(
            get: fn () => ElapsedTime::fromSeconds($this->spent_seconds),
        );
    }

    /**
     * @return Builder<Card>
     */
    public function buildSortQuery(): Builder
    {
        return static::query()
            ->where('bucket_id', '=', $this->bucket_id);
    }
}
