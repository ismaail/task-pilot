<?php

declare(strict_types=1);

use Domain\Timelog\ValueObject\ElapsedTime;

it('transforms seconds to elapsed time', function (
    int $source,
    int $expectedHours,
    int $expectedMinutes,
    int $expectedSeconds,
    string $expectedToHuman
): void {
    $elapsedTime = ElapsedTime::fromSeconds($source);

    expect($elapsedTime->hours)->toBe($expectedHours, "Wrong Hours expected value from '$source'.");
    expect($elapsedTime->minutes)->toBe($expectedMinutes, "Wrong Minutes expected value from '$source'.");
    expect($elapsedTime->seconds)->toBe($expectedSeconds, "Wrong Seconds expected value from '$source'.");
    expect($elapsedTime->toHuman())->toBe($expectedToHuman, "Wrong ToHuman expected value from '$source'.");
})->with([
    [60, 0, 1, 0, '00:01:00'],
    [120, 0, 2, 0, '00:02:00'],
    [145, 0, 2, 25, '00:02:25'],
    [3600, 1, 0, 0, '01:00:00'],
    [5700, 1, 35, 0, '01:35:00'],
    [15165, 4, 12, 45, '04:12:45'],
]);

it('returns total minutes', function (int $seconds, int $expectedTotalMinutes): void {
    $elapsedTime = ElapsedTime::fromSeconds($seconds);
    expect($elapsedTime->totalMinutes())->toBe($expectedTotalMinutes);
})->with([
    [30, 0],
    [60, 1],
    [150, 2],
    [180, 3],
    [200, 3],
]);

it('shows time in Human Minimal Format', function (int $seconds, string $expectedTime): void {
    $elapsedTime = ElapsedTime::fromSeconds($seconds);
    expect($elapsedTime->toHumanMinimal())->toBe($expectedTime, message: "Wrong Human Minimal Format for '$seconds' seconds.");
})->with([
    [0, '0 min'],
    [59, '0 min'],
    [60, '1min'],
    [120, '2min'],
    [3599, '59min'],
    [3600, '1H'],
    [3659, '1H'],
    [3660, '1H 1min'],
    [4200, '1H 10min'],
]);
