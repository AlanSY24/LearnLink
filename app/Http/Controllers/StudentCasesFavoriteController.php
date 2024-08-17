<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite; // 使用 Favorite 模型
use Illuminate\Support\Facades\Auth;

class StudentCasesFavoriteController extends Controller
{
    public function store(Request $request, $teacherRequestId)
    {
        $userId = $request->input('user_id', Auth::id()); // 獲取用戶ID或使用Auth
        
        // 創建或檢索 Favorite 記錄
        $favorite = Favorite::firstOrCreate([
            'user_id' => $userId,
            'teacher_request_id' => $teacherRequestId,
        ]);

        // 返回 JSON 響應
        return response()->json(['is_favorite' => true]);
    }

    public function destroy(Request $request, $teacherRequestId)
    {
        $userId = $request->input('user_id', Auth::id()); // 獲取用戶ID或使用Auth
        
        // 刪除 Favorite 記錄（如果存在）
        Favorite::where('user_id', $userId)
                ->where('teacher_request_id', $teacherRequestId)
                ->delete();

        // 返回 JSON 響應
        return response()->json(['is_favorite' => false]);
    }
}
