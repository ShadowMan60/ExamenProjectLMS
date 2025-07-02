<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Answer;

class AdminController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $email = $request->input('email');
        $password = $request->input('password');

        $user = User::where('email', $email)
                    ->where('role', 'admin')
                    ->first();

        if ($user && Hash::check($password, $user->password)) {
            return redirect()->route('admin.selectquiz');
        }

        return redirect()->route('admin.login.form')->with('error', 'Invalid credentials or not an admin.');
    }
    
    public function selectQuiz()
    {
        $quizzes = Quiz::all();

        return view('selectquizadmin', compact('quizzes'));
    }

    public function editquiz(Quiz $quiz)
    {
        $quiz->load('questions.answers');

        return view('editquiz', compact('quiz'));
    }

    public function addAdminUser()
    {
        $user = User::create([
            'name' => 'Neo',
            'email' => 'Neo@email.com',
            'password' => Hash::make('neo123#'),
            'role' => 'admin',
        ]);

        return 'Admin user created with id: ' . $user->id;
    }

    public function updateQuestion(Request $request, $id)
    {
        $request->validate(['text' => 'required|string']);
        $question = Question::findOrFail($id);
        $question->text = $request->input('text');
        $question->save();

        return redirect()->back()->with('success', 'Question updated.');
    }

    public function updateAnswer(Request $request, $id)
    {
        $request->validate(['text' => 'required|string']);
        $answer = Answer::findOrFail($id);
        $answer->text = $request->input('text');
        $answer->save();

        return redirect()->back()->with('success', 'Answer updated.');
    }

    public function addQuestionWithAnswers(Request $request)
    {
        $request->validate([
            'quiz_id' => 'required|exists:quizzes,id',
            'text' => 'required|string',
            'answers' => 'required|array|size:3',
            'answers.*.text' => 'required|string',
            'correct_answer' => 'required|integer|between:0,2',
        ]);

        $maxOrder = Question::where('quiz_id', $request->quiz_id)->max('order') ?? 0;

        // Create the question
        $question = new Question();
        $question->quiz_id = $request->quiz_id;
        $question->text = $request->text;
        $question->order = $maxOrder + 1;
        $question->save();

        // Create answers
        foreach ($request->answers as $index => $answerData) {
            $answer = new Answer();
            $answer->question_id = $question->id;
            $answer->text = $answerData['text'];
            $answer->correct = ($index == $request->correct_answer) ? 1 : 0;
            $answer->save();
        }

        return redirect()->back()->with('success', 'Question and answers added successfully.');
    }
    public function deleteQuestion($id)
    {
        $question = Question::findOrFail($id);

        // Optionally delete related answers
        $question->answers()->delete();

        $question->delete();

        return redirect()->back()->with('success', 'Question deleted successfully.');
    }
}
