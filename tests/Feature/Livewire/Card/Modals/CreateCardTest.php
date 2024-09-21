<?php

declare(strict_types=1);

use App\Livewire\Card\Forms\CardForm;
use App\Livewire\Card\Modals\CreateCard;
use Domain\Board\Models\Board;
use Domain\Bucket\Models\Bucket;
use Domain\User\Models\User;
use Livewire\Livewire;

it('Fails to create new Card with invalid form data', function (
    array $params = [],
    array $expectedErrors = [],
    array $expectedNoErrors = [],
): void {
    $user = User::factory()->create();

    $bucket = Bucket::factory()
        ->for(Board::factory()->create())
        ->create();

    $this->assertDatabaseCount('cards', 0);

    Livewire::actingAs($user)
        ->test(CreateCard::class, ['bucket' => $bucket])
        ->set('form.name', data_get($params, 'name'))
        ->set('form.description', data_get($params, 'description'))
        ->call('create')
        ->assertHasErrors($expectedErrors)
        ->assertHasNoErrors($expectedNoErrors)
        ;

    $this->assertDatabaseCount('cards', 0);
})->with([
    [
        'params' => [],
        'expectedErrors' => ['form.name' => 'The name field is required.'],
        'expectedNoErrors' => ['form.description'],
    ],
    [
        'params' => ['name' => 'Fo', 'description' => 'Ba'],
        'expectedErrors' => [
            'form.name' => 'The name field must be at least 3 characters.',
            'form.description' => 'The description field must be at least 3 characters.',
        ],
        'expectedNoErrors' => [''],
    ],
]);

it('create new Card with valid form data', function () {
    $user = User::factory()->create();

    $bucket = Bucket::factory()
        ->for(Board::factory()->create())
        ->create();

    $this->assertDatabaseCount('cards', 0);

    Livewire::actingAs($user)
        ->test(CreateCard::class, ['bucket' => $bucket])
        ->set('form.name', 'Card Name Example')
        ->set('form.description', 'Card Description Example')
        ->call('create')
        ->assertHasNoErrors(['form.name', 'form.description'])
    ;

    $this->assertDatabaseCount('cards', 1);
});
