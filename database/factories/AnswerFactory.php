<?php

namespace Database\Factories;

use App\Models\Answer;
use App\Models\Question;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AnswerFactory extends Factory
{
    protected $model = Answer::class;

    public function definition(): array
    {
        return [
            'body' => fake()->paragraph(),
            'file' => null,
            'question_id' => Question::factory(),
            'user_id' => User::factory(),
        ];
    }
}
