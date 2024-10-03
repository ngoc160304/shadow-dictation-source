<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use Illuminate\Http\Request;

class ExerciseController extends Controller
{
    public function getExerciseByTopicId($topicId, Request $request)
    {
        $limit = $request->query('_limit');

        if ($limit) {
            $exercises = Exercise::where('topicId', $topicId)->limit($limit)->get();
        } else {
            $exercises = Exercise::where('topicId', $topicId)->get();
        }

        if ($exercises->isEmpty()) {
            return response()->json([
                'error' => 'No exercises found for this topic'
            ], 404);
        }

        return response()->json([
            'exercises' => $exercises
        ], 200);
    }

    public function getExerciseById(Request $request)
    {
        $id = $request->query('id');
        
        $exercise = Exercise::find($id);
      
        if (!$exercise) {
            return response()->json([
                'error' => 'Exercise not found'
            ], 404);
        }

        
        return response()->json([
            'exercise' => $exercise
        ], 200);
    }
}
