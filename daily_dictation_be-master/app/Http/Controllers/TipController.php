<?php

namespace App\Http\Controllers;

use App\Models\Tip;
use Illuminate\Http\Request;

class TipController extends Controller
{
    public function getTipByIdExercise(Request $request)
    {
        $exerciseId = $request->query('exerciseId');

        if (!$exerciseId) {
            return response()->json([
                'error' => 'Exercise ID is required'
            ], 400);
        }

        $tips = Tip::where('exerciseId', $exerciseId)->get();

        if ($tips->isEmpty()) {
            return response()->json([
                'error' => 'No tips found for this exercise'
            ], 404);
        }

        return response()->json([
            'tips' => $tips
        ], 200);
    }

}
