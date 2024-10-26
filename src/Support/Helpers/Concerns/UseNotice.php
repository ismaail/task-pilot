<?php

declare(strict_types=1);

namespace Support\Helpers\Concerns;

use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Js;

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

    protected function flashNotice(NoticeType $type, string $message): void
    {
        Session::flash('notice', [
            'type' => $type->value,
            'message' => $message,
        ]);
    }

    #[Js]
    public function popFlash(): string
    {
        if (! Session::has('notice')) {
            return "''";
        }

        $noticeData = Session::get('notice');

        return <<<JS
          Livewire.dispatch('notice', {type: '{$noticeData['type']}', text: '{$noticeData['message']}'});
        JS;
    }
}
