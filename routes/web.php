<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\GuestController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/start', [GuestController::class, 'store'])->name('guest.start');

// User quiz selection
Route::get('/selectquiz', [GuestController::class, 'selectQuiz'])->name('selectquiz');

// Admin login form
Route::get('/adminacces', function () {
    return view('adminacces');
})->name('admin.login.form');

// Admin login processing
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login');

// Admin quiz management
Route::get('/admin/editquiz/{quiz}', [AdminController::class, 'editquiz'])->name('admin.editquiz');
Route::get('/addadminuser', [AdminController::class, 'addAdminUser']);
Route::get('/admin/selectquiz', [AdminController::class, 'selectQuiz'])->name('admin.selectquiz');
Route::put('/admin/edit-question/{id}', [AdminController::class, 'updateQuestion'])->name('admin.edit-question');
Route::put('/admin/edit-answer/{id}', [AdminController::class, 'updateAnswer'])->name('admin.edit-answer');
Route::post('/admin/add-question-with-answers', [AdminController::class, 'addQuestionWithAnswers'])->name('admin.add-question-with-answers');
Route::delete('/admin/delete-question/{id}', [AdminController::class, 'deleteQuestion'])->name('admin.delete-question');
Route::put('/admin/edit-answers/{question}', [AdminController::class, 'updateAnswersForQuestion']);

// Quiz routes
Route::get('/quiz/{quiz}', [QuizController::class, 'show'])->name('quiz.show');
Route::get('/quiz/{quiz}/questions', [QuizController::class, 'showQuestions'])->name('quiz.questions');

// Admin results route (moved to /admin/results to avoid conflict)
Route::get('/admin/results/{quiz}', [QuizController::class, 'showResult'])->name('quiz.results');

// User quiz routes handled by GuestController
Route::get('/quiz/{quiz}', [GuestController::class, 'showQuiz'])->name('quiz.show');

// User results route
Route::get('/results/{quizId}', [GuestController::class, 'showResult'])->name('showResult');
