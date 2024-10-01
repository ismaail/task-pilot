<?php

declare(strict_types=1);

namespace App\Livewire\Profile;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class TimelogsComponent extends Component
{
    public function render(): View
    {
        return view('livewire.timelogs-component');
    }
}
