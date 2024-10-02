<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tip extends Model
{
    use HasFactory;

    protected $fillable = [
        'content', 
        'exerciseId',
    ];

    public function exercise()
    {
        return $this->belongsTo(Exercise::class);
    }
}
