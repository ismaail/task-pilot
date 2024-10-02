<?php

declare(strict_types=1);

namespace Domain\Timelog\Actions;

use Carbon\CarbonImmutable;
use Domain\Card\DataObjects\CurrentCardDataObject;
use Domain\Timelog\Models\Timelog;
use Domain\Timelog\TimelogException;
use Illuminate\Support\Facades\DB;
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

        $finishedAt = CarbonImmutable::now();

        if ($card->startedAt->isSameDay($finishedAt)) {
            $this->create($card->id, $card->startedAt, $finishedAt);

            return;
        }

        if (! $card->startedAt->addDay()->isSameDay($finishedAt)) {
            throw new TimelogException('Diff between Start and Finish dates is more than 1 day.');
        }

        DB::transaction(function () use ($card, $finishedAt) {
            $this->create($card->id, $card->startedAt, $card->startedAt->endOfDay());
            $this->create($card->id, $finishedAt->startOfDay(), $finishedAt);
        });
    }

    private function create(int $cardId, CarbonImmutable $startedAt, CarbonImmutable $finishedAt): void
    {
        $secondsDiff = $startedAt->diffInSeconds($finishedAt);

        Timelog::create([
            'card_id' => $cardId,
            'started_at' => $startedAt,
            'finished_at' => $finishedAt,
            'elapsed_seconds' => round($secondsDiff),
        ]);
    }
}
