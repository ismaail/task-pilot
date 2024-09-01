<?php

declare(strict_types=1);

namespace Domain\Timelog\Actions;

use Carbon\CarbonImmutable;
use Domain\Card\DataObjects\CurrentCardDataObject;
use Domain\Timelog\Models\Timelog;
use Lorisleiva\Actions\Concerns\AsAction;

/**
 * @method static void run(CurrentCardDataObject $card)
 */
class CreateTimelogAction
{
    use AsAction;

    public function handle(CurrentCardDataObject $card): void
    {
        $now = CarbonImmutable::now();
        $secondsDiff = $card->startedAt->diffInSeconds($now);

        Timelog::create([
            'card_id' => $card->id,
            'started_at' => $card->startedAt,
            'finished_at' => $now,
            'elapsed_seconds' => round($secondsDiff),
        ]);
    }
}
