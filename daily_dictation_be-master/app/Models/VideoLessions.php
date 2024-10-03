<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoLessions extends Model
{
    use HasFactory;

    protected $table = 'video_lession';

    protected $fillable = [
        'title',
        'link_youtube',
    ];
}
