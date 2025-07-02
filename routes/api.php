<?php

use App\Http\Controllers\QuizController;

Route::get('/question/{question}/answers', [QuizController::class, 'getAnswers']);
