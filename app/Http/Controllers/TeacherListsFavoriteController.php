<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FavoriteStudent;
use Illuminate\Support\Facades\Auth;

class TeacherListsFavoriteController extends Controller
{
    public function store(Request $request, $teacherId)
    {
        $userId = $request->input('user_id', Auth::id()); // 获取当前登录用户的ID

        // 创建或更新收藏记录
        FavoriteStudent::updateOrCreate([
            'user_id' => $userId,
            'be_teachers_id' => $teacherId,
        ]);

        return response()->json(['is_favorite' => true]);
    }

    public function destroy(Request $request, $teacherId)
    {
        $userId = $request->input('user_id', Auth::id()); // 获取当前登录用户的ID

        // 删除收藏记录（如果存在）
        FavoriteStudent::where('user_id', $userId)
                       ->where('be_teachers_id', $teacherId)
                       ->delete();

        return response()->json(['is_favorite' => false]);
    }

    public function status($teacherId)
    {
        $userId = Auth::id(); // 获取当前登录用户的ID

        // 检查当前用户是否收藏了该教师
        $isFavorited = FavoriteStudent::where('user_id', $userId)
            ->where('be_teachers_id', $teacherId)
            ->exists();

        return response()->json(['isFavorited' => $isFavorited]);
    }
}
