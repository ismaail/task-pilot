<?php

declare(strict_types=1);

namespace Domain\Timelog\ValueObject;

readonly class ElapsedTime
{
    public function __construct(
        public int $hours,
        public int $minutes,
        public int $seconds,
    ) {
    }

    public static function fromSeconds(int $seconds): self
    {
        $hours = (int)round($seconds / 3600);
        $minutes = (int)(($seconds % 3600) / 60);

        return new self(
            hours: ($hours > 0) ? $hours : 0,
            minutes: ($hours > 0 || $minutes > 0) ? $minutes : 0,
            seconds: $seconds % 60 ?: 0,
        );
    }

    public function toHuman(): string
    {
        return sprintf('%02d:%02d:%02d', $this->hours, $this->minutes, $this->seconds);
    }
}
