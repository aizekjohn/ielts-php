<?php

namespace Database\Factories;

use App\Enums\WritingPart;
use App\Models\WritingCategory;
use App\Models\WritingQuestion;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class WritingCategoryFactory extends Factory
{
    protected $model = WritingCategory::class;

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
            category: 'Writing',
            fullPath: false,
            word: $name,
            format: 'jpg'
        );

        return [
            'name' => $name,
            'image' => 'images/faker/' . $filePath,
            'part' => $this->faker->randomElement(WritingPart::all()),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'order' => $this->faker->randomNumber(2),
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function (WritingCategory $writingCategory) {
            WritingQuestion::factory()->count(rand(20, 100))->create([
                'writing_category_id' => $writingCategory->id,
            ]);
        });
    }
}
