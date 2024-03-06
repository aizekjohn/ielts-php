<?php

namespace Database\Factories;

use App\Enums\UserGender;
use App\Enums\UserStatus;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->unique()->e164PhoneNumber(),
            'phone_verified_at' => now(),
            'otp_code' => rand(12345, 98765),
            'status' => fake()->randomElement(UserStatus::all()),
            'gender' => fake()->randomElement(UserGender::all()),
            'date_of_birth' => fake()->date('Y-m-d', '2005-01-01'),
            'password' => bcrypt('password'),
            'remember_token' => Str::random(10),
        ];
    }
}
