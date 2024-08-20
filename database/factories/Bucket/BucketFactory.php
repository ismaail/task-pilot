<?php

namespace Database\Factories\Bucket;

use Domain\Bucket\Models\Bucket;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Bucket>
 */
class BucketFactory extends Factory
{
    protected $model = Bucket::class;

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
