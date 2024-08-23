<?php

namespace App\Livewire;

use Domain\Board\Models\Board;
use Livewire\Component;

class BoardComponent extends Component
{
    public Board $board;

    public function render()
    {
        return view('livewire.board');
    }
}
