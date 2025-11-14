<?php

declare(strict_types=1);

namespace App\Livewire\Board\Modals;

use App\Livewire\Board\Forms\BoardForm;
use Domain\Board\Models\Board;
use Domain\Bucket\Models\Bucket;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use LivewireUI\Modal\ModalComponent;

class CreateBoard extends ModalComponent
{
    public BoardForm $form;

    public bool $withDefaultBuckets = false;

    public function create(): void
    {
        $this->validate();

        DB::transaction(function () {
            $board = Board::create($this->form->toArray());

            if ($this->withDefaultBuckets) {
                /** @var Bucket[] $buckets */
                $buckets = collect(['Backlog', 'To Do', 'In Progress', 'Done'])
                    ->map(fn ($name) => new Bucket(['name' => $name]))
                ;

                $board->buckets()->saveMany($buckets);
            }
        });

        $this->dispatch('closeModal');
        $this->dispatch('home-updated');
    }

    public function render(): View
    {
        return view('livewire.board.modals.create-board');
    }
}
