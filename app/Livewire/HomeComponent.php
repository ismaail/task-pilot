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

    /**
     * @var array<string, string>
     */
    protected $listeners = [
        'home-updated' => '$refresh',
    ];

    public function boot(#[CurrentUser] User $user): void
    {
        $this->user = $user;
    }

    /**
     * @param list<array{order: int, value: numeric-string}> $items
     */
    public function sortBoards(array $items): void
    {
        Board::setNewOrder(collect($items)->pluck('value'));
    }

    public function render(): View
    {
        $boards = Board::query()
            ->where('archived', false)
            ->get()
        ;

        return view('livewire.home-component')
            ->with('boards', $boards)
            ->with('current_board_id', $this->user->currentCard?->bucket->board_id)
        ;
    }
}
