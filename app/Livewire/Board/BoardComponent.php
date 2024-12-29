<?php

declare(strict_types=1);

namespace App\Livewire\Board;

use Domain\Board\Models\Board;
use Domain\Bucket\Models\Bucket;
use Domain\Card\Models\Card;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Livewire\Component;
use Support\Helpers\Concerns\NoticeType;
use Support\Helpers\Concerns\UseNotice;

class BoardComponent extends Component
{
    use UseNotice;

    public Board $board;

    public function mount(): void
    {
        $this->board->load([
            'buckets.cards' => fn (HasMany $q) => $q->where('archived', false)  // @todo: can be changed via request query.
        ]);
    }

    /**
     * @param array<array{order: int, value: numeric-string}> $items
     */
    public function sortBuckets(array $items): void
    {
        Bucket::setNewOrder(collect($items)->pluck('value'));
    }

    /**
     * @param array<array{order: int, value: numeric-string, items: array<array{order: int, value: numeric-string}>}> $items
     */
    public function sortCards(array $items): void
    {
        collect($items)->recursive()->each(function (Collection $bucketItem) {
            /** @var Collection<int, array{order: int, value: numeric-string}> $cardItems */
            $cardItems = $bucketItem->get('items');

            if ($cardItems->isEmpty()) {
                return;
            }

            // Adjust Cards if moved to new Bucket
            Card::query()
                ->whereIn('id', $cardItems->pluck('value'))
                ->update(['bucket_id' => $bucketItem->get('value')]);

            Card::setNewOrder($cardItems->pluck('value'));
        });
    }

    public function delete(): void
    {
        $this->board->delete();

        $this->flashNotice(NoticeType::Success, 'Board was successfully deleted.');

        redirect()->route('home');
    }

    public function archive(): void
    {
        $this->board->update(['archived' => true]);

        $this->flashNotice(NoticeType::Success, 'Board was successfully archived.');

        redirect()->route('home');
    }

    public function render(): View
    {
        return view('livewire.board.board-component')
            ->with('buckets', $this->board->buckets);
    }
}
