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
        $directory = 'public/images/faker';

        if (!Storage::exists($directory)) {
            Storage::makeDirectory($directory);
        }

        $filePath = $this->faker->image(
            dir: public_path('storage/images/faker'),
            width: 500,
            height: 500,
            category: 'Writing',
            fullPath: false,
            format: 'jpg'
        );

        return [
            'name' => $this->faker->word(),
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
