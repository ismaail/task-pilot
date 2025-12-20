<?php

declare(strict_types=1);

namespace App\Livewire;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\On;
use Livewire\Component;

class Pomodoro extends Component
{
    public ?Carbon $startedAt = null;

    public int $remainingSeconds = 1500; // 25 mins

    public bool $paused = true;

    public int $elapsedSeconds = 0;

    public function mount(): void
    {
        $state = Session::get('pomodoro');

        if ($state) {
            $this->startedAt = Carbon::parse($state['started_at']);
            $this->remainingSeconds = $state['remaining'];
            $this->paused = $state['paused'];

            $this->elapsedSeconds = $this->paused
                ? 0
                : abs((int)now()->diffInSeconds($state['started_at']));
        }

    }

    #[On('task.started')]
    public function onStarted(): void
    {
        $this->startedAt = now();

        // Detect finish
        if ($this->remainingSeconds <= 0) {
            $this->remainingSeconds = 1500; // reset to 25 min
            $this->elapsedSeconds = 0;
        }

        Session::put('pomodoro.started_at', $this->startedAt);
        Session::put('pomodoro.remaining', $this->remainingSeconds);
        Session::put('pomodoro.paused', false);

        $this->paused = false;

        $this->dispatch('pomodoro.started');
    }

    #[On('task.stoped')]
    public function onStoped(): void
    {
        if ($this->paused) {
            return;
        }

        $state = Session::get('pomodoro');
        if (! $state) {
            return;
        }

        $elapsedSeconds = abs((int)now()->diffInSeconds($state['started_at']));
        $remainingSeconds = (int)max(0, $state['remaining'] - $elapsedSeconds);

        Session::put('pomodoro.remaining', $remainingSeconds);
        Session::put('pomodoro.paused', true);

        $this->remainingSeconds = $remainingSeconds;
        $this->elapsedSeconds = 0;
        $this->paused = true;

        // If reached zero while pausing
        if ($remainingSeconds <= 0) {
            Session::forget('pomodoro');
            //auth()->user()->notify(new PomodoroFinished());
        }

        $this->dispatch('pomodoro.stoped');
    }

    public function render()
    {
        return view('livewire.pomodoro');
    }
}
