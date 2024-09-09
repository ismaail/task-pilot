<?php

declare(strict_types=1);

namespace App\Livewire\Card;

use Domain\Card\Actions\UpdateCurrentCardAction;
use Domain\Card\DataObjects\CurrentCardDataObject;
use Domain\Card\Models\Card;
use Domain\Timelog\Actions\CreateTimelogAction;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class CardComponent extends Component
{
    public Card $card;

    //protected $listeners = [
    //    'card-{card.id}-updated' => '$refresh'
    //];

    public function start(): void
    {
        $currentCard = CurrentCardDataObject::makeFromAuthUser();

        UpdateCurrentCardAction::run($this->card);

        if ($currentCard->id) {
            CreateTimelogAction::run($currentCard);
        }

        $this->refreshCard($currentCard);
    }

    public function stop(): void
    {
        $currentCard = CurrentCardDataObject::makeFromAuthUser();

        UpdateCurrentCardAction::run();

        CreateTimelogAction::run($currentCard);

        $this->refreshCard($currentCard);
    }

    public function render(): View
    {
        return view('livewire.card.card-component');
    }

    /**
     * Dispatch $refresh event.
     */
    private function refreshCard(CurrentCardDataObject $currentCard): void
    {
        if (! $currentCard->id) {
            return;
        }

        $this
            ->dispatch('$refresh.card.' . $currentCard->id)
            ->to('card.card-component');
    }
}
