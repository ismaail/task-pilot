<?php

declare(strict_types=1);

namespace App\Livewire\Bucket;

use Domain\Bucket\Models\Bucket;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Livewire\Component;

class BucketComponent extends Component
{
    public Bucket $bucket;

    /**
     * @var array<string, string>
     */
    protected $listeners = [
        'bucket-{bucket.id}-updated' => '$refresh',
    ];

    public function render(): View
    {
        $this->dispatch('refresh.preline.dropdown');

        $this->bucket->loadMissing([
            'cards' => fn (HasMany $q) => $q->where('archived', false),  // @todo: can be changed via request query.
        ]);

        return view('livewire.bucket.bucket-component')
            ->with('cards', $this->bucket->cards)
        ;
    }
}
