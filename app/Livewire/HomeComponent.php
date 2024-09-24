<?php

declare(strict_types=1);

namespace App\Livewire;

use Domain\Board\Models\Board;
use Domain\User\Models\User;
use Illuminate\Container\Attributes\CurrentUser;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class HomeComponent extends Component
{
    private User $user;

    public function boot(#[CurrentUser] User $user): void
    {
        $this->user = $user;
    }

    public function render(): View
    {
        return view('livewire.home-component')
            ->with('boards', Board::all())
            ->with('current_board_id', $this->user->currentCard?->bucket->board_id)
            ;
    }
}
