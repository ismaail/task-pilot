<?php

declare(strict_types=1);

namespace Support\Models\Concerns;

use Illuminate\Support\Str;

trait HasFactory
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;

    /**
     * @return \Illuminate\Database\Eloquent\Factories\Factory<static>
     */
    protected static function newFactory()
    {
        $parts = Str::of(static::class)->explode('\\');

        $domain = $parts[1];
        $model = $parts->last();

        return app("Database\\Factories\\{$domain}\\{$model}Factory");
    }
}
