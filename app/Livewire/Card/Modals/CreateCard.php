<?php

declare(strict_types=1);

namespace App\Livewire\Card\Modals;

use App\Livewire\Card\Forms\CardForm;
use Domain\Bucket\Models\Bucket;
use Illuminate\Contracts\View\View;
use LivewireUI\Modal\ModalComponent;

class CreateCard extends ModalComponent
{
    public Bucket $bucket;

    public CardForm $form;

    #[\Override]
    public static function modalMaxWidth(): string
    {
        return 'md';
    }

    #[\Override]
    public static function closeModalOnClickAway(): bool
    {
        return false;
    }

    public function create()
    {
        $this->validate();

        $this->bucket->loadCount('cards');

        $this->bucket->cards()->create([
            'name' => $this->form->name,
            'description' => $this->form->description ?? null,
            'sort' => $this->bucket->cards_count + 1
        ]);

        $this->dispatch('closeModal');
        $this->dispatch('$refresh')->to('board-component');
    }

    public function render(): View
    {
        return view('livewire.card.modals.create-card');
    }
}
