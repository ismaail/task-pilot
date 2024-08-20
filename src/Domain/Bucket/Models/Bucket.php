<?php

namespace Domain\Bucket\Models;

use Illuminate\Database\Eloquent\Model;
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
}
