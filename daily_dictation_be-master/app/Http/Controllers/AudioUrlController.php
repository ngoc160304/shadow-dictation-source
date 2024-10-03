<?php

namespace App\Http\Controllers;

use App\Models\AudioUrl;
use Illuminate\Http\Request;

class AudioUrlController extends Controller
{
    public function getAudioUrlByIdExercise(Request $request)
    {
        $exerciseId = $request->query('exerciseId');
    if (!$exerciseId) {
        return response()->json([
            'error' => 'Exercise ID is required'
        ], 400);
    }

    $audioUrls = AudioUrl::where('exerciseId', $exerciseId)->get();

    if ($audioUrls->isEmpty()) {
        return response()->json([
            'error' => 'No audio URLs found for this exercise'
        ], 404);
    }

    return response()->json([
        'audio_urls' => $audioUrls
    ], 200);
    }

    public function getAudioByIdExerciseLimit(Request $request)
{
    $exerciseId = $request->query('exerciseId');
    $limit = $request->query('_limit', 1);
    $start = $request->query('_start', 0);

    if (!$exerciseId) {
        return response()->json([
            'error' => 'Exercise ID is required'
        ], 400);
    }

    $audioUrls = AudioUrl::where('exerciseId', $exerciseId)
                ->orderBy('id', 'asc')
                ->skip($start)
                ->take($limit)
                ->get();

    if ($audioUrls->isEmpty()) {
        return response()->json([
            'error' => 'No audio URLs found for this exercise'
        ], 404);
    }

    return response()->json([
        'audioUrls' => $audioUrls
    ], 200);
}


    public function getAudioById(Request $request)
    {
        $id = $request->query('id');

        if (!$id) {
            return response()->json([
                'error' => 'Audio ID is required'
            ], 400);
        }

        $audioUrls = AudioUrl::find($id);

        if (!$audioUrls) {
            return response()->json([
                'error' => 'Audio not found'
            ], 404);
        }

        return response()->json([
            'audio_urls' => $audioUrls
        ], 200);
    }
}
