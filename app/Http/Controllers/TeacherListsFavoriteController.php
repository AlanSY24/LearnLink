<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FavoriteStudent;
use Illuminate\Support\Facades\Auth;

class TeacherListsFavoriteController extends Controller
{
    public function store(Request $request, $teacherId)
    {
        $userId = $request->input('user_id', Auth::id()); // Get the user ID from the request or fallback to Auth

        // Create or retrieve a FavoriteStudent record
        $favorite = FavoriteStudent::firstOrCreate([
            'user_id' => $userId,
            'be_teachers_id' => $teacherId,
        ]);

        // Return a JSON response indicating the favorite status
        return response()->json(['is_favorite' => true]);
    }

    public function destroy(Request $request, $teacherId)
    {
        $userId = $request->input('user_id', Auth::id()); // Get the user ID from the request or fallback to Auth

        // Delete the FavoriteStudent record if it exists
        FavoriteStudent::where('user_id', $userId)
                       ->where('be_teachers_id', $teacherId)
                       ->delete();

        // Return a JSON response indicating the favorite status
        return response()->json(['is_favorite' => false]);
    }
}