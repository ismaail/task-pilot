<?php

declare(strict_types=1);

uses(
    Tests\TestCase::class,
    \Illuminate\Foundation\Testing\RefreshDatabase::class,
)
    ->in('Feature')
;

uses(Tests\TestCase::class)
    ->in('Unit', 'Architecture')
;
