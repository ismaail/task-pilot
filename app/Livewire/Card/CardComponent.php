<?php

declare(strict_types=1);

namespace App\Livewire\Card;

use Domain\Card\Models\Card;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class CardComponent extends Component
{
    public Card $card;

    public function render(): View
    {
        return view('livewire.card.card-component');
    }
}
