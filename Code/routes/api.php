<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\QuestionApiController;
use App\Http\Controllers\Api\ResultApiController;

Route::get('/questions', [QuestionApiController::class, 'index']);
Route::get('/question/{question}/answers', [QuestionApiController::class, 'getAnswers']);

Route::post('/results', [ResultApiController::class, 'store']);
Route::get('/results/{user}', [ResultApiController::class, 'index']);
