<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'answerText', 
        'isCorrect', 
        'answeredAt', 
        'userExerciseId',
    ];

    public function userExercise()
    {
        return $this->belongsTo(UserExercise::class);
    }
}
