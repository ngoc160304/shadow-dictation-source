<?php

namespace App\Http\Controllers;

use App\Models\VideoLessions;
use Illuminate\Http\Request;

class VideoLessionController extends Controller
{
    public function index()
    {
        $videos = VideoLessions::all();

        return response()->json([
            'videos' => $videos
        ], 200);
    }
}
