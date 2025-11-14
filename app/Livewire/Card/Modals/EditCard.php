<?php

declare(strict_types=1);

namespace App\Livewire\Card\Modals;

use App\Livewire\Card\Forms\CardForm;
use Domain\Card\Models\Card;
use Illuminate\Contracts\View\View;
use LivewireUI\Modal\ModalComponent;

class EditCard extends ModalComponent
{
    public Card $card;

    public CardForm $form;

    public function update(): void
    {
        $this->validate();

        $this->card->update([
            'name' => $this->form->name,
            'description' => $this->form->description ?? null,
        ]);

        $this->dispatch('closeModal');
        $this->dispatch("card-{$this->card->id}-updated");
    }

    public function render(): View
    {
        $this->form->name = $this->card->name;
        $this->form->description = $this->card->description;

        return view('livewire.card.modals.edit-card');
    }
}
