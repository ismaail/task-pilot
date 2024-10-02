<?php

declare(strict_types=1);

namespace App\Livewire\Profile;

use Carbon\CarbonImmutable;
use Domain\Timelog\Models\Timelog;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class TimelogsComponent extends Component
{
    public function render(): View
    {
        $now = CarbonImmutable::now();

        return view('livewire.profile.timelogs-component', [
            'today' => Timelog::TotalTimeBetween($now),
            'yesterday' => Timelog::TotalTimeBetween($now->subDay(), $now->subDay()),
            'week' => Timelog::TotalTimeBetween($now->startOfWeek()),
            'month' => Timelog::TotalTimeBetween($now->startOfMonth()),
            'last_month' => Timelog::TotalTimeBetween($now->subMonth()->startOfMonth(), $now->subMonth()->endOfMonth()),
        ]);
    }
}
