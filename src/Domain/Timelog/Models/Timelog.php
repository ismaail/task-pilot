<?php

declare(strict_types=1);

namespace Domain\Timelog\Models;

use Domain\Card\Models\Card;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin IdeHelperTimelog
 */
class Timelog extends Model
{
    protected $fillable = [
        'started_at',
        'finished_at',
        'elapsed_seconds',
    ];

    protected function casts(): array
    {
        return [
            'started_at' => 'datetime',
            'finished_at' => 'datetime',
        ];
    }

    public $timestamps = false;

    public function card(): BelongsTo
    {
        return $this->belongsTo(Card::class, 'card_id', 'id');
    }
}
