<?php

declare(strict_types=1);

namespace Domain\Timelog\QueryBuilders;

use Carbon\CarbonImmutable;
use Domain\Timelog\Models\Timelog;
use Domain\Timelog\ValueObject\ElapsedTime;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

/**
 * @extends Builder<Timelog>
 */
class TimelogQueryBuilder extends Builder
{
    /**
     * @return Collection<int, array{day: CarbonImmutable, total_seconds: ?int, elapsed_time: ?ElapsedTime}>
     */
    public function elapsedTimesBetween(CarbonImmutable $from, ?CarbonImmutable $to = null, ?int $boardId = null): Collection
    {
        $to ??= CarbonImmutable::now()->endOfDay();

        $boardIdCondition = when($boardId, "AND boards.id = $boardId", '');

        $stmt = <<<SQL
            SELECT
                to_char(gs.day, 'YYYY-MM-dd') AS day,
                sum(timelogs.elapsed_seconds) AS total_seconds
            FROM "boards"
                RIGHT JOIN buckets on boards.id = buckets.board_id
                RIGHT JOIN cards on buckets.id = cards.bucket_id
                RIGHT JOIN timelogs on cards.id = timelogs.card_id
                RIGHT JOIN
                    generate_series(
                        timestamp '{$from->toIso8601String()}',
                        timestamp '{$to->toIso8601String()}',
                        '1 day'::interval
                    ) AS gs(day)
                    ON DATE(timelogs.started_at) = gs.day
                    {$boardIdCondition}
                    AND "timelogs"."started_at" >= '{$from->toIso8601String()}' AND "timelogs"."started_at" <= '{$to->toIso8601String()}'
            GROUP BY
                gs.DAY
            ORDER
                BY gs.day ASC
        SQL;

        return collect(DB::select($stmt))
            ->transform(function ($record) {
                $record->day = CarbonImmutable::parse($record->day);
                $record->elapsed_time = ElapsedTime::fromSeconds($record->total_seconds);

                return $record;
            });
    }
}
