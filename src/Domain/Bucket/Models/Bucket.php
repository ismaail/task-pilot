<?php

declare(strict_types=1);

namespace Domain\Bucket\Models;

use Domain\Board\Models\Board;
use Domain\Card\Models\Card;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Support\Models\Concerns\HasFactory;

/**
 * @mixin IdeHelperBucket
 */
class Bucket extends Model implements Sortable
{
    use HasFactory;
    use SortableTrait;

    protected $fillable = [
        'name',
        'archived',
    ];

    /**
     * @return BelongsTo<Board, Bucket>
     */
    public function board(): BelongsTo
    {
        return $this->belongsTo(Board::class, 'board_id', 'id');
    }

    /**
     * @return HasMany<Card>
     */
    public function cards(): HasMany
    {
        return $this->hasMany(Card::class, 'bucket_id', 'id')->ordered();
    }
}
