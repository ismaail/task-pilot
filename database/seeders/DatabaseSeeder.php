<?php

namespace Database\Seeders;

use Domain\Board\Models\Board;
use Domain\Board\Types\BoardMembership;
use Domain\User\Models\User;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Board::factory(5)
            ->hasAttached(User::factory(1), pivot: ['relation' => BoardMembership::Owner], relationship: 'members')
            ->hasAttached(User::factory(2), pivot: ['relation' => BoardMembership::Guest], relationship: 'members')
            ->create();
    }
}
