<?php

declare(strict_types=1);

namespace Domain\Timelog\Actions;

use Carbon\CarbonImmutable;
use Domain\Card\DataObjects\CurrentCardDataObject;
use Domain\Timelog\Models\Timelog;
use Domain\Timelog\TimelogException;
use Lorisleiva\Actions\Concerns\AsAction;

/**
 * @method static void run(CurrentCardDataObject $card)
 */
class CreateTimelogAction
{
    use AsAction;

    public function handle(CurrentCardDataObject $card): void
    {
        if (! $card->id || ! $card->startedAt) {
            throw new TimelogException('Cannot create Timelog without empty Card.');
        }

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
