<?php

namespace Database\Factories;

use App\Models\SpeakingAnswer;
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

    public function configure(): static
    {
        return $this->afterCreating(function (SpeakingQuestion $speakingQuestion) {
            SpeakingAnswer::factory()->count(rand(4, 15))->create([
                'question_id' => $speakingQuestion->id,
            ]);
        });
    }
}
