<?php

declare(strict_types=1);

namespace App\Livewire\Auth;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LoginComponent extends Component
{
    public LoginForm $form;

    public bool $failedAttempt = false;

    public function login(): void
    {
        $this->failedAttempt = false;

        $this->validate();

        if (Auth::attempt(credentials: ['email' => $this->form->email, 'password' => $this->form->password])) {
            $this->redirect('/boards/1'); // @TODO: Remove hardcoded redirect url.
        } else {
            $this->failedAttempt = true;
        }
    }

    public function render(): View
    {
        return view('livewire.auth.login-component');
    }
}
