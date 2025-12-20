<?php

declare(strict_types=1);

namespace Support\Toastify;

use Support\Toastify\Enums\ToastGravity;
use Support\Toastify\Enums\ToastPosition;
use Support\Toastify\Enums\ToastType;

trait Toast
{
    public function toast(
        string $text,
        ToastGravity $gravity = ToastGravity::Top,
        ToastPosition $position = ToastPosition::Right,
        ToastType $type = ToastType::Info,
        int $duration = 3000,
        bool $close = true,
    ): void {
        $this->dispatch('toast', [
            'text' => $text,
            'gravity' => $gravity,
            'position' => $position,
            'className' => $type,
            'duration' => $duration,
            'close' => $close,
        ]);
    }
}
