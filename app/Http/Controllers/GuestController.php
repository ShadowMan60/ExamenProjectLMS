<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Result;
use App\Models\ResultDetail;
use App\Models\Quiz;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => uniqid() . '@guest.local',
            'password' => bcrypt('guest1234'),
            'role' => 'user'
        ]);

        session(['user_id' => $user->id]);

        return redirect()->route('selectquiz');
    }

    public function selectQuiz()
    {
        $userId = session('user_id');
        $user = $userId ? User::find($userId) : null;

        // Get all quizzes for selection
        $quizzes = Quiz::all();

        return view('selectquiz', compact('user', 'quizzes'));
    }

    public function showQuiz(Quiz $quiz)
    {
        $quiz->load('questions.answers');

        return view('question', compact('quiz'));
    }

    public function showResult(Request $request, $quizId)
    {
        $userId = session('user_id');
        if (!$userId) {
            return redirect()->route('selectquiz')->with('error', 'Please start the quiz first.');
        }

        $userAnswers = json_decode($request->query('answers', '[]'), true);

        $quiz = Quiz::with('questions.answers')->findOrFail($quizId);

        $correctCount = 0;
        $totalQuestions = count($quiz->questions);

        $result = Result::create([
            'user_id' => $userId,
            'score' => 0,
        ]);

        foreach ($quiz->questions as $index => $question) {
            $selectedAnswerIndex = $userAnswers[$index] ?? null;
            $selectedAnswer = ($selectedAnswerIndex !== null) ? $question->answers[$selectedAnswerIndex] ?? null : null;
            $wasCorrect = $selectedAnswer ? (bool) $selectedAnswer->correct : false;

            if ($wasCorrect) {
                $correctCount++;
            }

            ResultDetail::create([
                'result_id' => $result->id,
                'question_id' => $question->id,
                'answer_id' => $selectedAnswer ? $selectedAnswer->id : null,
                'was_correct' => $wasCorrect,
            ]);
        }

        $result->score = $correctCount;
        $result->save();

        return view('result', [
            'correct' => $correctCount,
            'total' => $totalQuestions,
        ]);
    }
}
