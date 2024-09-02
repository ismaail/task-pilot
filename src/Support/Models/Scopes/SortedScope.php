<?php

declare(strict_types=1);

namespace Support\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;

trait SortedScope
{
    public static function bootSortedScope(): void
    {
        static::addGlobalScope(
            scope: 'sorted',
            implementation: fn(Builder $q) => $q->orderBy('sort', 'asc')
        );
    }
}
