<?php

declare(strict_types=1);

namespace Domain\Card\DataObjects;

use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Auth;

readonly class CurrentCardDataObject
{
    public function __construct(
        public ?int $id,
        public ?CarbonImmutable $startedAt,
    ) {
    }

    public static function makeFromAuthUser(): self
    {
        $user = Auth::user();

        return new self(
            id: $user?->current_card_id,
            startedAt: $user?->current_card_at,
        );
    }
}
