<?php

namespace Database\Factories;

use App\Models\Question;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionFactory extends Factory
{
    protected $model = Question::class;

    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'body' => fake()->paragraph(),
            'file' => 'file-questions/sample.pdf',
            'status' => 'revision',
            'user_id' => User::factory(),
            'teacher_id' => User::factory(),
            'topic_id' => Topic::factory(),
        ];
    }
}
