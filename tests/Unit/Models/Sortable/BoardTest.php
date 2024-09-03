<?php

use Domain\Board\Models\Board;
use Domain\Bucket\Models\Bucket;
use Domain\Card\Models\Card;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

it('Creates new Card with sort column in sequance', function () {
    Card::factory(3)
        ->for(
            Bucket::factory()->for(Board::factory(), relationship: 'board'),
            relationship: 'bucket'
        )
        ->create();

    $this->assertDatabaseCount('cards', 3);
    $this->assertDatabaseHas('cards', ['id' => 1, 'sort' => 1, 'bucket_id' => 1]);
    $this->assertDatabaseHas('cards', ['id' => 2, 'sort' => 2, 'bucket_id' => 1]);
    $this->assertDatabaseHas('cards', ['id' => 3, 'sort' => 3, 'bucket_id' => 1]);
});


it('Creates new Cards with sort column in sequance starting from a max value', function () {
    $bucket = Bucket::factory()
        ->for(Board::factory(), relationship: 'board')
        ->create();

    // Create 1st Card with sort = 4
    Card::withoutEvents(function () use ($bucket) {
        Card::factory(1)
            ->for($bucket, relationship: 'bucket')
            ->create(['sort' => 4]);
    });

    // Create 3 Cards
    Card::factory(3)
        ->for($bucket, relationship: 'bucket')
        ->create();

    $this->assertDatabaseCount('cards', 4);
    $this->assertDatabaseHas('cards', ['id' => 1, 'sort' => 4, 'bucket_id' => $bucket->id]);
    $this->assertDatabaseHas('cards', ['id' => 2, 'sort' => 5, 'bucket_id' => $bucket->id]);
    $this->assertDatabaseHas('cards', ['id' => 3, 'sort' => 6, 'bucket_id' => $bucket->id]);
    $this->assertDatabaseHas('cards', ['id' => 4, 'sort' => 7, 'bucket_id' => $bucket->id]);
});

it('Assign a sort value is segregatd by Bucket', function () {
    $buckets = Bucket::factory(2)
        ->for(Board::factory(), relationship: 'board')
        ->create();

    [$firstBucket, $secondBucket] = $buckets;

    // Create 1st Card for 1st Bucket with sort = 8
    Card::withoutEvents(function () use ($firstBucket) {
        Card::factory(1)
            ->for($firstBucket, relationship: 'bucket')
            ->create(['sort' => 3]);
    });

    // Create 1st Card for 2nd Bucket with sort = 2
    Card::withoutEvents(function () use ($secondBucket) {
        Card::factory(1)
            ->for($secondBucket, relationship: 'bucket')
            ->create(['sort' => 9]);
    });

    // Create 1 Card for 2nd Bucket
    Card::factory(1)
        ->for($firstBucket, relationship: 'bucket')
        ->create();

    $this->assertDatabaseCount('buckets', 2);
    $this->assertDatabaseCount('cards', 3);
    $this->assertDatabaseHas('cards', ['id' => 1, 'sort' => 3, 'bucket_id' => $firstBucket->id]);
    $this->assertDatabaseHas('cards', ['id' => 2, 'sort' => 9, 'bucket_id' => $secondBucket->id]);
    $this->assertDatabaseHas('cards', ['id' => 3, 'sort' => 4, 'bucket_id' => $firstBucket->id]);
});
