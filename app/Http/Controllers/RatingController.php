<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rating;
use App\Models\TeacherProfile;
use Illuminate\Support\Facades\Log;

class RatingController extends Controller
{
    public function rateTeacher(Request $request)
    {
        $request->validate([
            'teacher_id' => 'required|exists:teacher_profiles,user_id',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $existingRating = Rating::where('teacher_id', $request->teacher_id)
            ->where('user_id', auth()->id())
            ->first();

        if ($existingRating) {
            return response()->json(['message' => '你已經對該老師進行了評分'], 400);
        }

        $rating = Rating::create([
            'teacher_id' => $request->teacher_id,
            'user_id' => auth()->id(),
            'rating' => $request->rating,
        ]);

        return response()->json(['message' => '評分已成功提交', 'rating' => $rating]);
    }
    public function showTeacherRating(Request $request)
    {
        $teacher = Rating::where('teacher_id', $request->teacher_id)->firstOrFail();
        $averageRating = $teacher->avg('rating');
        $ratingCount = $teacher->count();
        return response()->json([
            'teacher_id' => $teacher,
            'average_rating' => $averageRating,
            'ratings_count' => $ratingCount,
        ]);
    }
}
