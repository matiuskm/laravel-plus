<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Episode>
 */
class EpisodeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence,
            'duration' => fake()->numberBetween(1, 60),
            'vimeo_id' => fake()->numerify('#########'),
            'overview' => fake()->paragraph(5),
        ];
    }
}
