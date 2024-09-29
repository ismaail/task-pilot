<?php

declare(strict_types=1);

namespace App\View\Components\Chart;

use Carbon\CarbonImmutable;
use Domain\Timelog\ValueObject\ElapsedTime;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;

class TimeChartComponent extends Component
{
    public function __construct(readonly protected ?int $boardId)
    {
    }

    public function render(): View
    {
        $now = CarbonImmutable::now();

        $timelogs = $this->getTimelogs(
            from: $now->subDays(30)->startOfDay(),
            to: $now->endOfDay(),
        );
        $labels = $timelogs->pluck('day')->map(fn(CarbonImmutable $d) => $d->format('M d'));
        $data = $timelogs->pluck('elapsed_time')->map(fn(ElapsedTime $t) => $t->minutes);

        return view('components.chart.time-chart-component')
            ->with('labels', $labels)
            ->with('data', $data)
            ;
    }

    /**
     * @return Collection<int, array{day: CarbonImmutable, total_seconds: ?int, elapsed_time: ?ElapsedTime}>
     */
    private function getTimelogs(CarbonImmutable $from, CarbonImmutable $to): Collection
    {
        $boardIdCondition = when($this->boardId, "AND boards.id = $this->boardId", '');

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
