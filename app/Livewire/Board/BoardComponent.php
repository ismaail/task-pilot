<?php

declare(strict_types=1);

namespace App\Livewire\Board;

use Domain\Board\Models\Board;
use Domain\Bucket\Models\Bucket;
use Domain\Card\Models\Card;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Livewire\Component;

class BoardComponent extends Component
{
    public Board $board;

    //protected $listeners = [
    //    'board-updated' => '$refresh',
    //];

    public function sortBuckets(array $items): void
    {
        Bucket::setNewOrder(collect($items)->pluck('value'));
    }

    public function sortCards(array $items): void
    {
        collect($items)->recursive()->each(function (Collection $bucketItem) {
            /** @var Collection $cardItems */
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

    public function render(): View
    {
        return view('livewire.board.board-component')
            ->with('buckets', $this->board->buckets()->get());
    }
}
