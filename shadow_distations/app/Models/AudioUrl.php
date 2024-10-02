<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AudioUrl extends Model
{
    use HasFactory;

    protected $fillable = [
        'url',
        'exerciseId',
        'transcript'
    ];

    public function exercise()
    {
        return $this->belongsTo(Exercise::class);
    }
}
