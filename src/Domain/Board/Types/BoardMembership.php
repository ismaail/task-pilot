<?php

declare(strict_types=1);

namespace Domain\Board\Types;

enum BoardMembership: string
{
    case Owner = 'Owner';
    case Guest = 'Guest';
}
