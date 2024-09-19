<?php

declare(strict_types=1);

namespace Domain\Board\Models;

use Domain\Bucket\Models\Bucket;
use Domain\User\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Support\Models\Concerns\HasFactory;

/**
 * @mixin IdeHelperBoard
 */
class Board extends Model
{
    use HasFactory;

    protected $table = 'boards';

    protected $fillable = [
        'name',
        'description',
        'archived',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'archived' => 'boolean',
        ];
    }

    /**
     * @return BelongsToMany<User>
     */
    public function members(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            table: 'boards_members',
            foreignPivotKey: 'board_id',
            relatedPivotKey: 'user_id'
        )
            ->as('membership')
            ->withPivot(['relation'])
            ->using(BoardMember::class)
            ;
    }

    /**
     * @return HasMany<Bucket>
     */
    public function buckets(): HasMany
    {
        return $this->hasMany(Bucket::class, 'board_id', 'id')->ordered();
    }
}
