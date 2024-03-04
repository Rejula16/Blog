<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\HashTag;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HashTag>
 */
class HashTagFactory extends Factory
{
    protected $model = HashTag::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        return [
            'name' => '#' . $this->faker->unique()->word,
            // Add more attributes as needed
        ];
    }
}
