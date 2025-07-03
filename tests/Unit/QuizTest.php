<?php

use App\Models\Quiz;

it('can create a quiz with a title', function () {
    $quiz = Quiz::factory()->make(['title' => 'Test Quiz']);
    
    expect($quiz->title)->toBe('Test Quiz');
});
