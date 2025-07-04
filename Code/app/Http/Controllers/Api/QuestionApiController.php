<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Question;

class QuestionApiController extends Controller
{
    // Return all questions with their answers
    public function index()
    {
        $questions = Question::with('answers')->get();
        return response()->json($questions);
    }

    // Return answers for a specific question
    public function getAnswers($questionId)
    {
        $question = Question::with('answers')->findOrFail($questionId);
        return response()->json($question->answers);
    }
}
