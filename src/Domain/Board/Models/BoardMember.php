<?php

declare(strict_types=1);

namespace Domain\Board\Models;

use Domain\Board\Types\BoardMembership;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * @mixin IdeHelperBoardMember
 */
class BoardMember extends Pivot
{
    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'relation' => BoardMembership::class,
        ];
    }
}
