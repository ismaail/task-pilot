<?php

declare(strict_types=1);

namespace App\View\Components\Utils;

use Illuminate\Container\Attributes\Config;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Notice extends Component
{
    /**
     * @var array<string, string> $positions
     */
    private array $positions = [
        'bottom-right' => 'flex-col-reverse',
        'top-right' => 'flex-col',
    ];

    public string $position;

    public function __construct(
        #[Config('utils.notice.position')] string $position,
        #[Config('utils.notice.auto_close')] public bool $autoClose,
        #[Config('utils.notice.time_close')] public int $timeClose,
    ) {
        $this->position = $this->positions[$position];
    }

    public function render(): View
    {
        return view('components.utils.notice');
    }
}
