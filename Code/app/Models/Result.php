<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Result extends Model
{
    use HasFactory;

    // Fillable fields for mass assignment
    protected $fillable = [
        'user_id',
        'score',
    ];

    // Relation: A Result belongs to a User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relation: A Result has many ResultDetails
    public function resultDetails()
    {
        return $this->hasMany(ResultDetail::class);
    }
}
