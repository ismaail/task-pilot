<?php

namespace App\Livewire\Card\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class CardForm extends Form
{
    #[Validate(['required', 'string', 'min:5', 'max:255'])]
    public string $name;

    #[Validate(['nullable', 'string', 'min:3'])]
    public string $description;
}
