<?php

namespace Database\Factories;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class NotificationFactory extends Factory
{
    protected $model = Notification::class;

    public function definition(): array
    {
        static $userIds;

        if (!isset($userIds)) {
            $userIds = User::latest()->limit(100)->pluck('id')->toArray();
        }

        return [
            'user_id' => $this->faker->randomElement($userIds),
            'body' => $this->faker->text,
            'is_read' => $this->faker->randomElement([true, false]),
        ];
    }
}
