<?php

declare(strict_types=1);

namespace Support\Helpers\Concerns;

trait UseNotice
{
    public function info(string $message): void
    {
        $this->notice('info', $message,);
    }

    public function success(string $message): void
    {
        $this->notice('success', $message,);
    }

    public function warning(string $message): void
    {
        $this->notice('warning', $message,);
    }

    public function error(string $message): void
    {
        $this->notice('error', $message,);
    }

    public function notice(string $type, string $message): void
    {
        $this->dispatch(
            'notice.add',
            [
                'type' => $type,
                'text' => $message,
            ]
        );
    }
}
