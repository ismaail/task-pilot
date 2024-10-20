<?php

declare(strict_types=1);

namespace App\Livewire\Auth;

use Livewire\Attributes\Validate;
use Livewire\Form;

class LoginForm extends Form
{
    #[Validate(['required', 'email'])]
    public string $email;

    #[Validate(['required', 'string'])]
    public string $password;

    #[Validate(['nullable', 'bool'])]
    public bool $remember = false;

    /**
     * @return array{email: string, password: string}
     */
    public function getCredentials(): array
    {
        return [
            'email' => $this->email,
            'password' => $this->password,
        ];
    }
}
