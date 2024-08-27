<?php

namespace App\Livewire;

use Domain\Board\Models\Board;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class BoardComponent extends Component
{
    public Board $board;

    public function render(): View
    {
        return view('livewire.board');
    }
}
