<?php

declare(strict_types=1);

namespace Database\Factories\Board;

use Domain\Board\Models\Board;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Board>
 */
class BoardFactory extends Factory
{
    protected $model = Board::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => Str::title(($this->faker->words(asText: true))),
        ];
    }
}
