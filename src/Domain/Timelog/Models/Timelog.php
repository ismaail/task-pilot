<?php

declare(strict_types=1);

namespace Domain\Timelog\Models;

use Domain\Card\Models\Card;
use Domain\Timelog\Observers\TimelogObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin IdeHelperTimelog
 */
#[ObservedBy(TimelogObserver::class)]
class Timelog extends Model
{
    protected $fillable = [
        'card_id',
        'started_at',
        'finished_at',
        'elapsed_seconds',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'started_at' => 'immutable_datetime',
            'finished_at' => 'immutable_datetime',
        ];
    }

    public $timestamps = false;

    /**
     * @return BelongsTo<Card, Timelog>
     */
    public function card(): BelongsTo
    {
        return $this->belongsTo(Card::class, 'card_id', 'id');
    }
}
