<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

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
        $filePath = $this->faker->image(
            dir: storage_path('app/public/images/faker'),
            width: 500,
            height: 500,
            category: 'NEWS',
            fullPath: false,
            format: 'jpg'
        );

        return [
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraph(25),
            'image' => 'images/faker/' . $filePath,
            'views' => $this->faker->numberBetween(0, 5555),
            'with_push' => $this->faker->randomElement([true, false]),
        ];
    }
}
