<?php

namespace Database\Factories\Task;

use Domain\Task\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Task>
 */
class TaskFactory extends Factory
{
    protected $model = Task::class;

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
