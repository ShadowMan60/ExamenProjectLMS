<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Question;
use App\Models\Answer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class QuizController extends Controller
{

    public function show(Quiz $quiz)
    {
        $quiz->load('questions.answers');

        return view('quiz.show', compact('quiz'));
    }

    public function getAnswers(Question $question)
    {
        return response()->json(
            $question->answers()->select('id', 'text')->get()
        );
    }
}
