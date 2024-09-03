<?php

declare(strict_types=1);

namespace Domain\Timelog\Observers;

use Domain\Card\Models\Card;
use Domain\Timelog\Models\Timelog;

class TimelogObserver
{
    public function created(Timelog $timelog): void
    {
        $sumSeconds = Timelog::query()
            ->where('card_id', '=', $timelog->card_id)
            ->sum('elapsed_seconds');

        Card::query()
            ->where('id', '=', $timelog->card_id)
            ->update(['spent_seconds' => $sumSeconds]);
    }
}
