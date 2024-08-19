<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite; // 使用 Favorite 模型
use Illuminate\Support\Facades\Auth;
use App\Models\TeacherRequest; // 确保 TeacherRequest 模型存在

class StudentCasesFavoriteController extends Controller
{
    public function store(Request $request, $teacherRequestId)
    {
        $userId = $request->input('user_id', Auth::id());

        // 检查请求 ID 是否存在
        $teacherRequestExists = TeacherRequest::find($teacherRequestId);
        if (!$teacherRequestExists) {
            return response()->json(['error' => 'Teacher request not found'], 404);
        }

        // 创建或检索 Favorite 记录
        Favorite::firstOrCreate([
            'user_id' => $userId,
            'teacher_request_id' => $teacherRequestId,
        ]);

        return response()->json(['is_favorite' => true]);
    }

    public function destroy(Request $request, $teacherRequestId)
    {
        $userId = $request->input('user_id', Auth::id());

        // 检查请求 ID 是否存在
        $teacherRequestExists = TeacherRequest::find($teacherRequestId);
        if (!$teacherRequestExists) {
            return response()->json(['error' => 'Teacher request not found'], 404);
        }

        // 删除 Favorite 记录（如果存在）
        Favorite::where('user_id', $userId)
                ->where('teacher_request_id', $teacherRequestId)
                ->delete();

        return response()->json(['is_favorite' => false]);
    }


    public function status($teacherRequestId)
    {
        $userId = Auth::id(); // 获取当前登录用户的ID

        // 检查 TeacherRequest 是否存在
        $teacherRequest = TeacherRequest::find($teacherRequestId);

        if (!$teacherRequest) {
            return response()->json(['error' => 'Teacher request not found'], 404);
        }

        // 检查当前用户是否收藏了该教师请求
        $isFavorited = Favorite::where('user_id', $userId)
            ->where('teacher_request_id', $teacherRequestId)
            ->exists();

        return response()->json(['isFavorited' => $isFavorited]);
    }

}
