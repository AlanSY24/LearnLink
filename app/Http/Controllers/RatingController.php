<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rating;
use App\Models\TeacherProfile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

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

    public function showTeacherRating2($teacherId)
    {
        $userId = auth()->id();
        $rating = Rating::where('teacher_id', $teacherId)
                        ->where('user_id', $userId)
                        ->first();

        if ($rating) {
            return response()->json(['rating' => $rating->rating]);
        } else {
            return response()->json(['rating' => null]);
        }
    }

     // 新增的顯示教師評分統計的功能
     public function showTeacherRatingStatistics($teacherId)
    {
        try {
            // 确保 teacherId 是有效的整数
            if (!is_numeric($teacherId) || $teacherId <= 0) {
                return response()->json(['error' => 'Invalid teacher ID.'], 400);
            }

            // 计算平均评分
            $averageRating = Rating::where('teacher_id', $teacherId)->avg('rating');
            
            // 计算评分数量
            $ratingCount = Rating::where('teacher_id', $teacherId)->count();

            // 如果没有评分记录，设置默认值
            if ($averageRating === null) {
                $averageRating = 0.0;
            }

            return response()->json([
                'average_rating' => number_format($averageRating, 1), // 保留一位小数
                'rating_count' => $ratingCount,
            ]);
        } catch (\Exception $e) {
            // 记录异常信息
            \Log::error("Error fetching teacher rating statistics: " . $e->getMessage());
            return response()->json([
                'error' => 'Unable to fetch rating statistics.',
            ], 500);
        }
    }
    public function getUserRating(Request $request)
    {
        $request->validate([
            'case_id' => 'required',
            'teacher_id' => 'required|exists:teacher_profiles,user_id',
        ]);

        $rating = Rating::where('case_id', $request->case_id)
            ->where('teacher_id', $request->teacher_id)
            ->where('user_id', auth()->id())
            ->first();

        return response()->json([
            'rating' => $rating ? $rating->rating : null,
        ]);
    }
    public function rateTeacher2(Request $request)
    {
        $request->validate([
            'case_id' => 'required',
            'teacher_id' => 'required|exists:teacher_profiles,user_id',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        if ($request->teacher_id == Auth::id()) {
            return response()->json(['message' => '您不能對自己進行評分。'], 403);
        }

        $existingRating = Rating::where('case_id', $request->case_id)
            ->where('teacher_id', $request->teacher_id)
            ->where('user_id', auth()->id())
            ->first();

        if ($existingRating) {
            return response()->json(['message' => '你已經對該案子進行了評分'], 400);
        }

        $rating = Rating::create([
            'case_id' => $request->case_id,
            'teacher_id' => $request->teacher_id,
            'user_id' => auth()->id(),
            'rating' => $request->rating,
        ]);

        return response()->json(['message' => '評分已成功提交', 'rating' => $rating]);
    }
     
}
