<?php

namespace Database\Factories\Card;

use Domain\Card\Models\Card;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Card>
 */
class CardFactory extends Factory
{
    protected $model = Card::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => Str::title(($this->faker->words(nb: random_int(4, 10), asText: true))),
        ];
    }
}
