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

    public static function fromSeconds(?int $seconds): self
    {
        if (! $seconds) {
            return new self(0, 0, 0);
        }

        $hours = (int)floor($seconds / 3600);
        $minutes = (int)floor(($seconds % 3600) / 60);

        return new self(
            hours: ($hours > 0) ? $hours : 0,
            minutes: ($hours > 0 || $minutes > 0) ? $minutes : 0,
            seconds: $seconds % 60 ?: 0,
        );
    }

    public function totalMinutes(): int
    {
        return ($this->hours * 60) + $this->minutes;
    }

    public function toHuman(): string
    {
        return sprintf('%02d:%02d:%02d', $this->hours, $this->minutes, $this->seconds);
    }

    public function toHumanMinimal(): string
    {
        if (0 === $this->hours && 0 === $this->minutes) {
            return '0 min';
        }

        $hours = $this->hours > 0 ? "{$this->hours}H" : '';
        $minutes = $this->minutes > 0 ? "{$this->minutes}min" : '';

        return trim("$hours $minutes");
    }
}
