<?php

declare(strict_types=1);

namespace App\Livewire;

use Domain\Bucket\Models\Bucket;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class BucketComponent extends Component
{
    public Bucket $bucket;

    //protected $listeners = [
    //    'bucket-{bucket.id}-updated' => '$refresh',
    //];

    public function render(): View
    {
        //$this->dispatch('refresh.preline.dropdown');

        return view('livewire.bucket-component')
            ->with('cards', $this->bucket->cards()->get());
    }
}
