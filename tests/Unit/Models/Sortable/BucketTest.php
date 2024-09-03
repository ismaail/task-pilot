<?php

use Domain\Board\Models\Board;
use Domain\Bucket\Models\Bucket;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

it('Creates new Bucket with sort column in sequance', function () {
    Bucket::factory(3)
        ->for(Board::factory(), relationship: 'board')
        ->create();

    $this->assertDatabaseCount('buckets', 3);
    $this->assertDatabaseHas('buckets', ['id' => 1, 'sort' => 1]);
    $this->assertDatabaseHas('buckets', ['id' => 2, 'sort' => 2]);
    $this->assertDatabaseHas('buckets', ['id' => 3, 'sort' => 3]);
});


it('Creates new Bucket with sort column in sequance starting from a max value', function () {
    $board = Board::factory();

    Board::withoutEvents(function () use ($board) {
        Bucket::factory(1)
            ->for($board, relationship: 'board')
            ->create(['sort' => 3]);
    });

    Bucket::factory(2)
        ->for($board, relationship: 'board')
        ->create();

    $this->assertDatabaseCount('buckets', 3);
    $this->assertDatabaseHas('buckets', ['id' => 1, 'sort' => 3]);
    $this->assertDatabaseHas('buckets', ['id' => 2, 'sort' => 4]);
    $this->assertDatabaseHas('buckets', ['id' => 3, 'sort' => 5]);
});
