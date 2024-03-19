<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\News>
 */
class NewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraph(25),
            'image' => $this->faker->imageUrl(),
            'views' => $this->faker->numberBetween(0, 5555),
            'with_push' => $this->faker->randomElement([true, false]),
        ];
    }
}
