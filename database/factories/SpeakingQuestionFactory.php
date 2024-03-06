<?php

namespace Database\Factories;

use App\Models\SpeakingQuestion;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class SpeakingQuestionFactory extends Factory
{
    protected $model = SpeakingQuestion::class;

    public function definition(): array
    {
        return [
            'body' => $this->faker->realTextBetween(30, 70),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'order' => $this->faker->randomNumber(2),
        ];
    }
}
