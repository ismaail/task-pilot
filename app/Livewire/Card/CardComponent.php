<?php

declare(strict_types=1);

namespace App\Livewire\Card;

use Domain\Card\Actions\UpdateCurrentCardAction;
use Domain\Card\DataObjects\CurrentCardDataObject;
use Domain\Card\Models\Card;
use Domain\Timelog\Actions\CreateTimelogAction;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Support\Helpers\Concerns\UseNotice;

class CardComponent extends Component
{
    use UseNotice;

    public Card $card;

    /**
     * @var array<string, string>
     */
    protected $listeners = [
        'card-{card.id}-updated' => '$refresh'
    ];

    public function start(): void
    {
        $currentCard = CurrentCardDataObject::makeFromAuthUser();

        UpdateCurrentCardAction::run($this->card);

        if ($currentCard->id) {
            CreateTimelogAction::run($currentCard);
        }

        $this->refreshCard($currentCard);
        $this->success('Task started successfully.');
    }

    public function stop(): void
    {
        $currentCard = CurrentCardDataObject::makeFromAuthUser();

        UpdateCurrentCardAction::run();

        CreateTimelogAction::run($currentCard);

        $this->refreshCard($currentCard);
        $this->success('Task Stoped successfully.');
    }

    public function delete(): void
    {
        $bucketId = $this->card->bucket_id;

        $this->card->delete();

        $this->dispatch("bucket-$bucketId-updated");
        $this->success('Task Deleted successfully.');
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

        $this->dispatch("card-{$currentCard->id}-updated");
    }
}
