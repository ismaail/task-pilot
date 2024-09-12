<?php

namespace Database\Seeders;

use Domain\Board\Models\Board;
use Domain\Board\Types\BoardMembership;
use Domain\Bucket\Models\Bucket;
use Domain\Card\Models\Card;
use Domain\User\Models\User;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Board::factory(1)
            ->hasAttached(
                User::factory(1)->state(['name' => 'Tester', 'email' => 'test@example.com']),
                pivot: ['relation' => BoardMembership::Owner],
                relationship: 'members'
            )
            ->hasAttached(User::factory(2), pivot: ['relation' => BoardMembership::Guest], relationship: 'members')
            ->has(Bucket::factory(4)
                ->sequence(
                    ['name' => 'Backlog', 'sort' => 1],
                    ['name' => 'To Do', 'sort' => 2],
                    ['name' => 'In Progess', 'sort' => 3],
                    ['name' => 'Done', 'sort' => 4],
                )
                ->has(Card::factory(random_int(3, 10))))
            ->create(['name' => 'Example']);
    }
}
