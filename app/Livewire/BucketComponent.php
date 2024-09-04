<?php

declare(strict_types=1);

namespace App\Livewire;

use Domain\Bucket\Models\Bucket;
use Domain\Card\Models\Card;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

#[On('$refresh.bucket.{bucket.id}')]
class BucketComponent extends Component
{
    public Bucket $bucket;

    public function sort(int $cardId, int $position): void
    {
        $card = Card::findOrFail($cardId);

        if ($card->sort === $position && $card->bucket_id === $this->bucket->id) {
            return;
        }

        if ($card->bucket_id !== $this->bucket->id) {
            $card->bucket_id = $this->bucket->id;
            $card->save();
        }

        $cards = Card::query()
            ->select(['id', 'sort'])
            ->where('bucket_id', '=', $this->bucket->id)
            ->ordered()
            ->get()
            ->pluck('id');

        /** @var \Illuminate\Support\Collection $collection */
        $collection = $cards->splice($position);
        $index = $collection->search(fn ($v, $k) => $v === $card->id);
        $collection->forget($index);
        $collection->unshift($card->id);

        Card::setNewOrder($cards->merge($collection), 0);
    }

    public function render(): View
    {
        $this->dispatch('refresh.preline.dropdown');

        return view('livewire.bucket-component');
    }
}
