<?php

declare(strict_types=1);

use App\Livewire\Card\CardComponent;
use Domain\Board\Models\Board;
use Domain\Bucket\Models\Bucket;
use Domain\Card\Models\Card;
use Domain\User\Models\User;
use Livewire\Livewire;

it('renders the board component', function () {
    $user = User::factory()->create();

    $card = Card::factory()
        ->for(Bucket::factory()->for(Board::factory()->create())->create())
        ->create(['name' => 'Task Example']);

    $this->assertDatabaseCount('cards', 1);

    Livewire::actingAs($user)
        ->test(CardComponent::class, ['card' => $card])
        ->assertStatus(200)
        ->assertSee('Task Example')
        ->call('delete')
        ->assertDispatched('bucket-1-updated')
        ;

    $this->assertDatabaseCount('cards', 0);
});
