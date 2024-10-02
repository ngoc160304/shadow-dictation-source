<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    public function getListTopicByQuantity($number)
    {
        $topics = Topic::limit($number)->get();

        return response()->json([
            'topics' => $topics
        ], 200);
    }

    public function getTopicList()
    {
        $topics = Topic::all();

        return response()->json([
            'topics' => $topics
        ], 200);
    }

    public function getTopicById(Request $request)
{
    $id = $request->query('id');

    if (!$id) {
        return response()->json([
            'error' => 'Topic ID is required'
        ], 400);
    }

    $topic = Topic::find($id);

    if (!$topic) {
        return response()->json([
            'error' => 'Topic not found'
        ], 404);
    }

    return response()->json([
        'topic' => $topic
    ], 200);
}

}
