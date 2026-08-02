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
        return [
            'title' => fake()->sentence(4),
            'notification' => fake()->paragraph(),
            'admin_id' => User::factory(),
        ];
    }
}
