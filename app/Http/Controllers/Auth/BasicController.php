<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth; // 確保使用 Auth
use App\Models\User; // 確保使用 User 模型

class BasicController extends Controller
{
    public function infoEdit(Request $request)
    {
        // 驗證輸入數據
        $request->validate([
            'name' => 'nullable|string|max:255', // 名稱，最多255個字元
            'gender' => 'nullable|in:0,1,2', // 性別，值只能是0, 1, 2
            'phone' => 'nullable|string', // 可以為空，並且是字串
            'birthday' => 'nullable|date', // 可以為空，並且是有效日期
        ]);

        $user = Auth::user();
        
        // 更新用戶資料
        if ($request->has('name')) {
            $user->name = $request->input('name');
        }
        if ($request->has('gender')) {
            $user->gender = $request->input('gender');
        }
        if ($request->has('phone')) {
            $user->phone = $request->input('phone');
        }
        if ($request->has('birthday')) {
            $user->birthday = $request->input('birthday');
        }

        // 儲存更新
        $user->save();

        // 重定向到指定的路由
        return Redirect::route('auth.status');
    }
}
