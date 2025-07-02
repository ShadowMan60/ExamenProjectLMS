<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Quiz;

class QuizController extends Controller
{
    public function show(Quiz $quiz)
    {
        // Load questions and their answers eagerly
        $quiz->load('questions.answers');

        return view('quiz.show', compact('quiz'));
    }

    public function editQuestion(Question $question)
    {
        // Pass question and answers to edit form
        $question->load('answers');

        return view('quiz.edit_question', compact('question'));
    }

    public function updateQuestion(Request $request, Question $question)
    {
        // Validate and update question text and answers here (simplified)
        $request->validate([
            'text' => 'required|string',
            'answers' => 'required|array',
            'answers.*.text' => 'required|string',
        ]);

        $question->text = $request->input('text');
        $question->save();

        // Update answers (simplified, you might want to add more checks)
        foreach ($request->input('answers') as $answerId => $answerData) {
            $answer = $question->answers()->find($answerId);
            if ($answer) {
                $answer->text = $answerData['text'];
                $answer->save();
            }
        }

        return redirect()->route('quiz.show', $question->quiz_id)->with('success', 'Question updated.');
    }

    public function deleteQuestion(Question $question)
    {
        // Prevent deleting question with order 1
        if ($question->order == 1) {
            return redirect()->route('quiz.show', $question->quiz_id)
                ->with('error', 'Cannot delete the first question of a quiz.');
        }

        $quizId = $question->quiz_id;
        $question->delete();

        return redirect()->route('quiz.show', $quizId)->with('success', 'Question deleted.');
    }
}

public function getAnswers(Question $question)
{
    return response()->json($question->answers()->select('id', 'text')->get());
}
