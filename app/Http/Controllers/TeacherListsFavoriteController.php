<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FavoriteStudent;
use App\Models\User;
use App\Models\BeTeacher;
use Illuminate\Support\Facades\Auth;

class TeacherListsFavoriteController extends Controller
{
    /**
     * Add a teacher to the user's favorites.
     *
     * @param Request $request
     * @param int $teacherId
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, $teacherId)
    {
        try {
            $userId = $request->input('user_id', Auth::id()); // Get the current logged-in user ID

            // Check if the user and teacher exist
            $userExists = User::find($userId);
            $teacherExists = BeTeacher::find($teacherId);

            if (!$userExists || !$teacherExists) {
                return response()->json(['error' => 'User or Teacher not found'], 404);
            }

            // Create or update the favorite record
            FavoriteStudent::updateOrCreate([
                'user_id' => $userId,
                'be_teachers_id' => $teacherId,
            ]);

            return response()->json(['is_favorite' => true]);
        } catch (\Exception $e) {
            \Log::error('Favorite addition failed: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to add favorite'], 500);
        }
    }

    /**
     * Remove a teacher from the user's favorites.
     *
     * @param Request $request
     * @param int $teacherId
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, $teacherId)
    {
        try {
            $userId = $request->input('user_id', Auth::id()); // Get the current logged-in user ID

            // Check if the user and teacher exist
            $userExists = User::find($userId);
            $teacherExists = BeTeacher::find($teacherId);

            if (!$userExists || !$teacherExists) {
                return response()->json(['error' => 'User or Teacher not found'], 404);
            }

            // Delete the favorite record if it exists
            FavoriteStudent::where('user_id', $userId)
                           ->where('be_teachers_id', $teacherId)
                           ->delete();

            return response()->json(['is_favorite' => false]);
        } catch (\Exception $e) {
            \Log::error('Favorite removal failed: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to remove favorite'], 500);
        }
    }

    /**
     * Check if the teacher is favorited by the user.
     *
     * @param int $teacherId
     * @return \Illuminate\Http\JsonResponse
     */
    public function status($teacherId)
    {
        try {
            $userId = Auth::id(); // Get the current logged-in user ID

            // Check if the user and teacher exist
            $userExists = User::find($userId);
            $teacherExists = BeTeacher::find($teacherId);

            if (!$userExists || !$teacherExists) {
                return response()->json(['error' => 'User or Teacher not found'], 404);
            }

            // Check if the teacher is favorited by the user
            $isFavorited = FavoriteStudent::where('user_id', $userId)
                ->where('be_teachers_id', $teacherId)
                ->exists();

            return response()->json(['isFavorited' => $isFavorited]);
        } catch (\Exception $e) {
            \Log::error('Failed to check favorite status: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to check favorite status'], 500);
        }
    }
}
