<?php

use Carbon\CarbonImmutable;
use Domain\Card\DataObjects\CurrentCardDataObject;
use Domain\Card\Models\Card;
use Domain\Timelog\Actions\CreateTimelogAction;
use Domain\User\Models\User;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

it('creates a naw Timelog for current Active Card in Same Day', function () {
    /** @var Card $card */
    $card = Card::factory()->create();

    /** @var User $user */
    $user = User::factory()->create([
        'current_card_id' => $card->id,
        'current_card_at' => '2024-03-10 16:30:10',
    ]);

    $this->actingAs($user);

    $this->assertDatabaseCount('timelogs', 0);

    // Freez Time
    $date = CarbonImmutable::create(2024, 3, 10, 16, 30, 12);
    CarbonImmutable::setTestNow($date);

    CreateTimelogAction::run(CurrentCardDataObject::makeFromAuthUser());

    $this->assertDatabaseCount('timelogs', 1);
    $this->assertDatabaseHas('timelogs', [
        'card_id' => $card->id,
        'started_at' => '2024-03-10 16:30:10',
        'finished_at' => '2024-03-10 16:30:12',
        'elapsed_seconds' => 2,
    ]);
});

it('creates a naw Timelog for current Active Card between 2 Days', function () {
    /** @var Card $card */
    $card = Card::factory()->create();

    /** @var User $user */
    $user = User::factory()->create([
        'current_card_id' => $card->id,
        'current_card_at' => '2024-03-10 23:40:00',
    ]);

    $this->actingAs($user);

    $this->assertDatabaseCount('timelogs', 0);

    // Freez Time
    $date = CarbonImmutable::create(2024, 3, 11, 00, 10, 00);
    CarbonImmutable::setTestNow($date);

    CreateTimelogAction::run(CurrentCardDataObject::makeFromAuthUser());

    $this->assertDatabaseCount('timelogs', 2);
    $this->assertDatabaseHas('timelogs', [
        'card_id' => $card->id,
        'started_at' => '2024-03-10 23:40:00', // 20 min
        'finished_at' => '2024-03-10 23:59:59', // 10 min
        'elapsed_seconds' => 1200, // 20 min
    ]);
    $this->assertDatabaseHas('timelogs', [
        'card_id' => $card->id,
        'started_at' => '2024-03-11 00:00:00', // 20 min
        'finished_at' => '2024-03-11 00:10:00', // 10 min
        'elapsed_seconds' => 600,
    ]);
});

it('Throw error If Card start & Finish date are more than 1 day. ', function () {
    /** @var Card $card */
    $card = Card::factory()->create();

    /** @var User $user */
    $user = User::factory()->create([
        'current_card_id' => $card->id,
        'current_card_at' => '2024-03-10 23:40:00',
    ]);

    $this->actingAs($user);

    $this->assertDatabaseCount('timelogs', 0);

    // Freez Time
    $date = CarbonImmutable::create(2024, 3, 12, 00, 10, 00);
    CarbonImmutable::setTestNow($date);

    $this->expectException(\Domain\Timelog\TimelogException::class);

    $this->assertDatabaseCount('timelogs', 0);
    CreateTimelogAction::run(CurrentCardDataObject::makeFromAuthUser());
});
