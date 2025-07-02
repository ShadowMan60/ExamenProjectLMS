<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Question;
use App\Models\Answer;

class AnswerSeeder extends Seeder
{
    public function run()
    {
        $questions = Question::all();

        if ($questions->isEmpty()) {
            echo "No questions found. Seeder skipped.\n";
            return;
        }

        foreach ($questions as $question) {
            Answer::create([
                'question_id' => $question->id,
                'text' => 'Answer A for Q' . $question->id,
                'correct' => true,
            ]);

            Answer::create([
                'question_id' => $question->id,
                'text' => 'Answer B for Q' . $question->id,
                'correct' => false,
            ]);

            Answer::create([
                'question_id' => $question->id,
                'text' => 'Answer C for Q' . $question->id,
                'correct' => false,
            ]);
        }

        echo "Seeded answers for {$questions->count()} questions.\n";
    }
}
