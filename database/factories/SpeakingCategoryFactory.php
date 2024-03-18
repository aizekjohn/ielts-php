<?php

namespace Database\Factories;

use App\Enums\SpeakingPart;
use App\Models\SpeakingCategory;
use App\Models\SpeakingQuestion;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class SpeakingCategoryFactory extends Factory
{
    protected $model = SpeakingCategory::class;

    public function definition(): array
    {
        $directory = 'images/faker';

        if (!Storage::exists($directory)) {
            Storage::makeDirectory($directory);
        }

        $name = $this->faker->word();

        $filePath = $this->faker->image(
            dir: storage_path('app/public/images/faker'),
            width: 500,
            height: 500,
            category: 'Speaking',
            fullPath: false,
            word: $name,
            format: 'jpg'
        );

        return [
            'name' => $name,
            'image' => 'images/faker/' . $filePath,
            'part' => $this->faker->randomElement(SpeakingPart::all()),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'order' => $this->faker->randomNumber(2),
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function (SpeakingCategory $speakingCategory) {
            SpeakingQuestion::factory()->count(rand(20, 100))->create([
                'speaking_category_id' => $speakingCategory->id,
            ]);
        });
    }
}
