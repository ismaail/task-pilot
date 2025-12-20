<?php

declare(strict_types=1);

namespace App\Livewire\Card;

use Domain\Card\Actions\UpdateCurrentCardAction;
use Domain\Card\DataObjects\CurrentCardDataObject;
use Domain\Card\Models\Card;
use Domain\Timelog\Actions\CreateTimelogAction;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Support\Toastify\Enums\ToastType;
use Support\Toastify\Toast;

class CardComponent extends Component
{
    use Toast;

    public Card $card;

    /**
     * @var array<string, string>
     */
    protected $listeners = [
        'card-{card.id}-updated' => '$refresh',
    ];

    public function start(): void
    {
        $currentCard = CurrentCardDataObject::makeFromAuthUser();

        UpdateCurrentCardAction::run($this->card);

        if ($currentCard->id) {
            CreateTimelogAction::run($currentCard);
        }

        $this->refreshCard($currentCard);
        $this->dispatch('task.started');
        $this->toast('Task started successfully.', type: ToastType::Success);
        $this->toggleFavicon(true);
    }

    public function stop(): void
    {
        $currentCard = CurrentCardDataObject::makeFromAuthUser();

        UpdateCurrentCardAction::run();

        CreateTimelogAction::run($currentCard);

        $this->refreshCard($currentCard);
        $this->dispatch('task.stoped');
        $this->toast('Task Stoped successfully.', type: ToastType::Success);
        $this->toggleFavicon(false);
    }

    public function archive(): void
    {
        $this->card->update(['archived' => true]);

        $this->dispatch("bucket-{$this->card->bucket_id}-updated");
        $this->toast('Task Archived successfully.', type: ToastType::Success);
    }

    private function toggleFavicon(bool $value): void
    {
        $this->dispatch('swap-favicon', ['is_busy' => $value]);
    }

    public function delete(): void
    {
        $bucketId = $this->card->bucket_id;

        $this->card->delete();

        $this->dispatch("bucket-$bucketId-updated");
        $this->toast('Task Deleted successfully.', type: ToastType::Success);
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
