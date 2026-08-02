<?php

namespace Database\Factories;

use App\Models\Topic;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TopicFactory extends Factory
{
    protected $model = Topic::class;

    public function definition(): array
    {
        return [
            'topic' => fake()->sentence(3),
            'description' => fake()->paragraph(),
            'teacher_id' => User::factory(),
        ];
    }
}
