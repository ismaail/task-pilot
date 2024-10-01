<?php

declare(strict_types=1);

namespace App\View\Components\Chart;

use Carbon\CarbonImmutable;
use Domain\Timelog\Models\Timelog;
use Domain\Timelog\ValueObject\ElapsedTime;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TimeChartComponent extends Component
{
    public function __construct(readonly protected ?int $boardId)
    {
    }

    public function render(): View
    {
        $now = CarbonImmutable::now();

        $timelogs = Timelog::elapsedTimesBetween(
            from: $now->subDays(30)->startOfDay(),
            to: $now->endOfDay(),
            boardId: $this->boardId,
        );
        $labels = $timelogs->pluck('day')->map(fn(CarbonImmutable $d) => $d->format('M d'));
        $data = $timelogs->pluck('elapsed_time')->map(fn(ElapsedTime $t) => $t->totalMinutes());

        return view('components.chart.time-chart-component')
            ->with('labels', $labels)
            ->with('data', $data)
            ;
    }
}
