<?php

namespace Database\Factories;

use App\Enums\BandScore;
use App\Models\WritingAnswer;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class WritingAnswerFactory extends Factory
{
    protected $model = WritingAnswer::class;

    public function definition(): array
    {
        return [
            'band' => $this->faker->randomElement(BandScore::all()),
            'body' => $this->faker->realTextBetween(50, 100),
            'order' => $this->faker->randomNumber(2),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
