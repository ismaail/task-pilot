<?php

declare(strict_types=1);

namespace App\Livewire\Card\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class CardForm extends Form
{
    #[Validate(['required', 'string', 'min:3', 'max:255'])]
    public string $name;

    #[Validate(['nullable', 'string', 'min:3'])]
    public ?string $description;
}
