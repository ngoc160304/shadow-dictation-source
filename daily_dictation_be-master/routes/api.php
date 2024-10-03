<?php

use App\Http\Controllers\AudioUrlController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\TipController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\TranscriptController;
use App\Http\Controllers\VideoLessionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/users', [AuthController::class, 'getUserById']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::get('/users/top', [AuthController::class, 'topUser']);

// Route::middleware(['check.token'])->group(function () {

// });

    Route::get('/topics/{number}', [TopicController::class, 'getListTopicByQuantity']);
    Route::get('/topics', [TopicController::class, 'getTopicList']);
    Route::get('/topics/{request}', [TopicController::class, 'getTopicById']);

    //Exercise
    Route::get('/exercises/topics/{topicId}/{limit}', [ExerciseController::class, 'getExerciseByTopicId']);
    Route::get('/exercises', [ExerciseController::class, 'getExerciseById']);

    //Tip
    Route::get('/tips', [TipController::class, 'getTipByIdExercise']);

    //AudioUrl
    Route::get('/audioUrls', [AudioUrlController::class, 'getAudioUrlByIdExercise']);
    Route::get('/audioUrles', [AudioUrlController::class, 'getAudioByIdExerciseLimit']);
    Route::get('/audioUrl', [AudioUrlController::class, 'getAudioById']);

    //videoLession
    Route::get('/videoLessons', [VideoLessionController::class, 'index']);
