<?php

declare(strict_types=1);

namespace App\Livewire\Board;

use Domain\Board\Models\Board;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class TimelogsComponent extends Component
{
    public Board $board;

    public function render(): View
    {
        return view('livewire.board.timelog-component');
    }
}
