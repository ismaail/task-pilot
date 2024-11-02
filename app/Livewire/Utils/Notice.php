<?php

declare(strict_types=1);

namespace App\Livewire\Utils;

use Illuminate\Container\Attributes\Config;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Js;
use Livewire\Component;

class Notice extends Component
{
    public string $position;

    public bool $autoClose;

    public int $timeClose;

    /**
     * @var array<string, string> $positions
     */
    private array $positions = [
        'bottom-right' => 'flex-col-reverse',
        'top-right' => 'flex-col',
    ];

    public function boot(
        #[Config('utils.notice.position')] string $position,
        #[Config('utils.notice.auto_close')] bool $autoClose,
        #[Config('utils.notice.time_close')] int $timeClose,
    ) {
        $this->autoClose = $autoClose;
        $this->timeClose = $timeClose;

        $this->position = $this->positions[$position];
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

    public function render()
    {
        return view('livewire.utils.notice');
    }
}
