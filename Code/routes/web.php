<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\GuestController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/start', [GuestController::class, 'store'])->name('guest.start');
Route::get('/selectquiz', [GuestController::class, 'selectQuiz'])->name('selectquiz');
Route::get('/quiz/{quiz}', [GuestController::class, 'showQuiz'])->name('quiz.show');
Route::get('/results/{quizId}', [GuestController::class, 'showResult'])->name('showResult');

Route::get('/adminacces', function () {
    return view('adminacces');
})->name('admin.login.form');

Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::get('/admin/selectquiz', [AdminController::class, 'selectQuiz'])->name('admin.selectquiz');
Route::get('/admin/editquiz/{quiz}', [AdminController::class, 'editquiz'])->name('admin.editquiz');
Route::put('/admin/edit-question/{id}', [AdminController::class, 'updateQuestion'])->name('admin.edit-question');
Route::put('/admin/edit-answer/{id}', [AdminController::class, 'updateAnswer'])->name('admin.edit-answer');
Route::put('/admin/edit-answers/{question}', [AdminController::class, 'updateAnswersForQuestion'])->name('admin.edit-answers');
Route::post('/admin/add-question-with-answers', [AdminController::class, 'addQuestionWithAnswers'])->name('admin.add-question-with-answers');
Route::delete('/admin/delete-question/{id}', [AdminController::class, 'deleteQuestion'])->name('admin.delete-question');
Route::get('/admin/results/{quiz}', [QuizController::class, 'showResult'])->name('quiz.results');
Route::get('/addadminuser', [AdminController::class, 'addAdminUser']);
