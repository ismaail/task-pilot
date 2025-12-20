<?php

declare(strict_types=1);

namespace Support\Toastify\Enums;

enum ToastType: string
{
    case Error = 'danger';
    case Info = 'info';
    case Success = 'success';
    case Warning = 'warning';
}
