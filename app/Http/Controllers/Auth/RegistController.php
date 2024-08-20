<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\User;

class RegistController extends Controller
{
    public function verify(Request $request)
    {
        $code = $request->code;
        $registrationData = $request->session()->get('registration_data');

        if (!$registrationData) {
            return response()->json(['success' => false, 'message' => '註冊資料不存在或已過期']);
        }

        $email = $registrationData['email'];
        $cachedData = Cache::get('something' . $email);

        if (!$cachedData || $cachedData['verifyCode'] != $code) {
            return response()->json(['success' => false, 'message' => '驗證碼錯誤或已過期']);
        }

        // 驗證成功，創建新用戶
        $user = new User();
        $user->email = $email;
        $user->account = $registrationData['account'];
        $user->name = $registrationData['name'];
        $user->gender = $registrationData['gender'];
        $user->password = $registrationData['password'];

        $user->save();

        // 清除 session 和 cache 中的註冊數據
        $request->session()->forget('registration_data');
        Cache::forget('something' . $email);

        return response()->json(['success' => true, 'message' => '用戶註冊成功']);
    }
}