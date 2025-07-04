<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Answer;
use App\Models\User;

class TestDataSeeder extends Seeder
{
    public function run(): void
    {
        Quiz::factory(3)->create()->each(function ($quiz) {
            Question::factory(3)->create(['quiz_id' => $quiz->id])->each(function ($question) {
                Answer::factory()->count(3)->sequence(
                    ['correct' => 1],
                    ['correct' => 0],
                    ['correct' => 0]
                )->create(['question_id' => $question->id]);
            });
        });

        User::factory()->create([
            'name' => 'Admin QA',
            'email' => 'qa_admin@example.com',
            'password' => bcrypt('securePass!'),
            'role' => 'admin',
        ]);
    }
}
