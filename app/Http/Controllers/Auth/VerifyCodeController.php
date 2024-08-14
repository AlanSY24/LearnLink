<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class VerifyCodeController extends Controller
{
    public function verify(Request $request)
    {
        $email = $request->email;
        $code = $request->code;
        $newPassword = $request->newPassword;

        $cachedData = Cache::get('user_registration_' . $email);

        if ($cachedData && $cachedData['verifyCode'] == $code) {
            // 验证码正确，更新密码
            $user = User::where('email', $email)->first();
            if ($user) {
                $user->password = Hash::make($newPassword);
                $user->save();
                
                // 清除缓存中的验证码
                Cache::forget('user_registration_' . $email);
                
                return response()->json(['success' => true, 'message' => '驗證碼正確，密碼已成功重設']);
            } else {
                return response()->json(['success' => false, 'message' => '找不到對應的用戶']);
            }
        } else {
            return response()->json(['success' => false, 'message' => '驗證碼不正確']);
        }
    }
}