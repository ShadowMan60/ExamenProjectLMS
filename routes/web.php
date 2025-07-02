<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\QuizController;

Route::get('/', function () {
    return view('welcome');
});


Route::post('/start', [\App\Http\Controllers\GuestController::class, 'store'])->name('guest.start');
Route::get('/selectquiz', fn() => view('selectquiz'))->name('selectquiz');

Route::get('/adminacces', function () {
    return view('adminacces');
})->name('admin.login.form');

Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::get('/admin/editquiz/{quiz}', [AdminController::class, 'editquiz'])->name('admin.editquiz');
Route::get('/addadminuser', [AdminController::class, 'addAdminUser']);
Route::get('/admin/selectquiz', [AdminController::class, 'selectQuiz'])->name('admin.selectquiz');
Route::put('/admin/edit-question/{id}', [AdminController::class, 'updateQuestion'])->name('admin.edit-question');
Route::put('/admin/edit-answer/{id}', [AdminController::class, 'updateAnswer'])->name('admin.edit-answer');
Route::post('/admin/add-question-with-answers', [AdminController::class, 'addQuestionWithAnswers'])->name('admin.add-question-with-answers');
Route::delete('/admin/delete-question/{id}', [AdminController::class, 'deleteQuestion'])->name('admin.delete-question');
Route::get('/quiz/{quiz}', [QuizController::class, 'show'])->name('quiz.show');
Route::get('/question/{question}/edit', [QuizController::class, 'editQuestion'])->name('question.edit');
Route::post('/question/{question}', [QuizController::class, 'updateQuestion'])->name('question.update');
Route::delete('/question/{question}', [QuizController::class, 'deleteQuestion'])->name('question.delete');
