<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ResultDetail extends Model
{
    use HasFactory;

    // Fillable fields for mass assignment
    protected $fillable = [
        'result_id',
        'question_id',
        'answer_id',
        'was_correct',
    ];

    // Relation: A ResultDetail belongs to a Result
    public function result()
    {
        return $this->belongsTo(Result::class);
    }

    // Relation: A ResultDetail belongs to a Question
    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    // Relation: A ResultDetail belongs to an Answer
    public function answer()
    {
        return $this->belongsTo(Answer::class);
    }
}
