<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:8',
            'dob' => 'required|date',
            'bio' => 'nullable|string',
        ]);

        $hashedPassword = Hash::make($request->password);

        $existingUser = User::where('username', $request->username)
            ->orWhere('password', $hashedPassword)
            ->first();

        if ($existingUser) {
            return response()->json([
                'error' => 'Username or Password already exists!'
            ], 500);
        }

        $user = User::create([
            'username' => $request->username,
            'password' => $hashedPassword,
            'dateJoined' => now(),
            'dob' => $request->dob,
            'bio' => $request->bio,
            'startTime' => null,
            'endTime' => null
        ]);

        return response()->json([
            'message' => 'User registered successfully!',
            'user' => $user
        ], 200);
    }

    public function getUserById (Request $request) {
        $id = $request->query('id');

        if (!$id) {
            return response()->json([
                'error' => 'User id is required'
            ], 400);
        }

        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'error' => 'User not found'
            ], 404);
        }

        return response()->json([
            'users' => $user
        ], 200);
    }

        public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('username', $request->username)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        $token = Str::random(60);

        $user->update([
            'remember_token' => $token,
            'startTime' => now(),
        ]);

        return response()->json([
            'message' => 'Login successful',
            'token' => $token,
            'user' => $user
        ], 200);
    }

    public function logout(Request $request)
    {
        $token = $request->bearerToken();

        if (!$token) {
            return response()->json(['error' => 'Token is missing'], 400);
        }

        $user = User::where('remember_token', $token)->first();

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $endTime = now();
        $startTime = Carbon::parse($user->startTime);

        $diffInSeconds = $endTime->diffInSeconds($startTime);
        $totalLoggedInTime = $user->totalLoggedInTime ?? 0;
        $user->update([
            'totalLoggedInTime' => $totalLoggedInTime + $diffInSeconds,
            'endTime' => $endTime,
            'remember_token' => null,
        ]);

        return response()->json([
            'message' => 'Logout successful',
            'totalLoggedInTime' => gmdate('H:i:s', $user->totalLoggedInTime),
        ], 200);
    }

    public function topUser(Request $request)
    {
        $limit = $request->query('_limit', 30);
        $sort = $request->query('_sort', 'endTime');

        $users = User::get()->map(function ($user) {
            $totalHours = floor(($user->totalLoggedInTime ?? 0) / 3600);
            $user->totalHours = $totalHours > 21 ? '21+' : $totalHours;
            return $user;
        });

        if ($sort === 'endTime') {
            $sortedUsers = $users->sortByDesc('endTime');
        } else {
            $sortedUsers = $users->sortByDesc(function ($user) {
                return $user->totalHours === '21+' ? 999 : $user->totalHours;
            });
        }

        $limitedUsers = $sortedUsers->take($limit)->values();

        return response()->json([
            'users' => $limitedUsers
        ], 200);
    }
}
