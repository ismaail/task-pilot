<?php

declare(strict_types=1);

namespace App\Livewire\Board\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class BoardForm extends Form
{
    #[Validate(['required', 'string', 'min:3', 'max:255'])]
    public string $name;
}
