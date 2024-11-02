<?php

declare(strict_types=1);

namespace Support\Helpers\Concerns;

enum NoticeType: string
{
    case Notice = 'notice';
    case Info = 'info';
    case Success = 'success';
    case Warning = 'warning';
    case Error = 'error';
}
