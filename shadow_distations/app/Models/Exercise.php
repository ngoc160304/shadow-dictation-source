<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'createAt',
        'topicId',
        'audioUrl',
        'textMain'
    ];

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function userExercises()
    {
        return $this->hasMany(UserExercise::class);
    }

    public function audioUrls()
    {
        return $this->hasMany(AudioUrl::class);
    }
}
