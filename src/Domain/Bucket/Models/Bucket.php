<?php

namespace Domain\Bucket\Models;

use Domain\Card\Models\Card;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Support\Models\Concerns\HasFactory;

/**
 * @mixin IdeHelperBucket
 */
class Bucket extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'archived',
    ];

    public function cards(): HasMany
    {
        return $this->hasMany(Card::class, 'bucket_id', 'id');
    }
}
