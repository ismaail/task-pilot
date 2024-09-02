<?php

namespace Domain\Bucket\Models;

use Domain\Card\Models\Card;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Support\Models\Concerns\HasFactory;
use Support\Models\Scopes\SortedScope;

/**
 * @mixin IdeHelperBucket
 */
class Bucket extends Model
{
    use HasFactory;
    use SortedScope;

    protected $fillable = [
        'name',
        'archived',
    ];

    public function cards(): HasMany
    {
        return $this->hasMany(Card::class, 'bucket_id', 'id');
    }
}
