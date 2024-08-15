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

        $cachedData = Cache::get('something' . $email);

        if ($cachedData && $cachedData['verifyCode'] == $code) {
            $user = User::where('email', $email)->first();
            if ($user) {
                $user->password = Hash::make($newPassword);
                $user->save();
                
                // 清除 cache 中的驗證碼
                Cache::forget('something' . $email);
                
                return response()->json(['success' => true, 'message' => '驗證碼正確，密碼已成功重設']);
            } else {
                return response()->json(['success' => false, 'message' => '找不到對應的用戶']);
            }
        } else {
            return response()->json(['success' => false, 'message' => '驗證碼不正確']);
        }
    }
}
