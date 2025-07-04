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
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => uniqid() . '@guest.local',
            'password' => bcrypt('guest1234'),
            'role' => 'user',
        ]);

        session(['user_id' => $user->id]);

        return redirect()->route('selectquiz');
    }

    public function selectQuiz()
    {
        $user = session('user_id') ? User::find(session('user_id')) : null;
        $quizzes = Quiz::all();

        return view('selectquiz', compact('user', 'quizzes'));
    }

    public function showQuiz(Quiz $quiz)
    {
        $quiz->load('questions.answers');

        return view('question', compact('quiz'));
    }

    public function showResult(Request $request, int $quizId)
    {
        $userId = session('user_id');
        if (!$userId) {
            return redirect()->route('selectquiz')->with('error', 'Please start the quiz first.');
        }

        $userAnswers = json_decode($request->query('answers', '[]'), true);
        $quiz = Quiz::with('questions.answers')->findOrFail($quizId);

        $correctCount = 0;
        $result = Result::create([
            'user_id' => $userId,
            'score' => 0,
        ]);

        foreach ($quiz->questions as $index => $question) {
            $selectedIndex = $userAnswers[$index] ?? null;
            $selectedAnswer = $selectedIndex !== null ? $question->answers[$selectedIndex] ?? null : null;
            $isCorrect = $selectedAnswer && $selectedAnswer->correct;

            if ($isCorrect) {
                $correctCount++;
            }

            ResultDetail::create([
                'result_id' => $result->id,
                'question_id' => $question->id,
                'answer_id' => $selectedAnswer?->id,
                'was_correct' => $isCorrect,
            ]);
        }

        $result->update(['score' => $correctCount]);

        return view('result', [
            'correct' => $correctCount,
            'total' => count($quiz->questions),
        ]);
    }
}
