<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Quiz;
use App\Models\Question;

class QuizSeeder extends Seeder
{
    public function run()
    {
        $quiz1 = Quiz::create(['name' => 'Quiz 1']);

        $quiz1->questions()->createMany([
            ['text' => 'Question 1 for Quiz 1', 'order' => 1],
            ['text' => 'Question 2 for Quiz 1', 'order' => 2],
        ]);

        $quiz2 = Quiz::create(['name' => 'Quiz 2']);

        $quiz2->questions()->createMany([
            ['text' => 'Question 1 for Quiz 2', 'order' => 1],
            ['text' => 'Question 2 for Quiz 2', 'order' => 2],
        ]);

        $quiz3 = Quiz::create(['name' => 'Quiz 3']);

        $quiz3->questions()->createMany([
            ['text' => 'Question 1 for Quiz 3', 'order' => 1],
            ['text' => 'Question 2 for Quiz 3', 'order' => 2],
        ]);
    }
}
