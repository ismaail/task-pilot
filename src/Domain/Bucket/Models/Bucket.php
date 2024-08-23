<?php

namespace Domain\Bucket\Models;

use Domain\Task\Models\Task;
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

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class, 'bucket_id', 'id');
    }
}
