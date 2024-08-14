<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;

class EmailController extends Controller
{
    public function sendEmail(Request $request)
    {
        $verifyCode = rand(100000, 999999);
        $email = $request->email;

        try {
            Mail::raw("您的驗證碼是 $verifyCode", function ($message) use ($email) {
                $message->to($email)
                    ->subject("驗證碼");
            });

            // 將驗證碼和用戶資料存入 Cache，持續 10 分鐘
            Cache::put('user_registration_' . $email, ['verifyCode' => $verifyCode], 600);

            return response()->json(['success' => true, 'message' => 'email寄送成功']);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'email 發送失敗',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}