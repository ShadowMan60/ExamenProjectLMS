<?php

namespace Database\Factories;

use App\Models\Quiz;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuizFactory extends Factory
{
    protected $model = Quiz::class;

    public function definition()
    {
        $this->faker->addProvider(new \Faker\Provider\Lorem($this->faker));
        return [
            'title' => $this->faker->sentence(3),

        ];
    }
}