<?php

namespace Database\Factories;

use App\Models\WritingQuestion;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class WritingQuestionFactory extends Factory
{
    protected $model = WritingQuestion::class;

    public function definition(): array
    {
        return [
            'body' => $this->faker->realTextBetween(50, 100),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'order' => $this->faker->randomNumber(2),
        ];
    }
}
