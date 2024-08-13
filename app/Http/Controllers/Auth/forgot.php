<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;

class forgot extends Controller
{
    public function forgot(Request $request)
    {
        $request->validate([
            'forgotAccount' => 'required',
            'forgotEmail' => 'required|email',
        ]);

        // 查詢資料表中是否有匹配的帳號和電子郵件
        $user = User::where('account', $request->forgotAccount)
            ->where('email', $request->forgotEmail)
            ->first();
        /*找出'account'欄位中跟forgotAccount相等的資料(可能不只一筆，也可能沒有)
        然後在這些篩選過的資料中找出'email'欄位跟forgotEmail的資料(也可能不只一筆，也可能沒有)，
        然後在篩選過量次的資料中取第一筆，將其回傳給$user，若沒有則返回null。*/

        if ($user) {
            $verifyCode = rand(100000, 999999);
            $email = $request->forgotEmail;
            $account = $request->forgotAccount;



            try {
                // 發送email
                Mail::raw("您的驗證碼是 $verifyCode", function ($message) use ($email) {
                    $message->to($email)
                        ->subject("LeanLink家教平台重設密碼驗證碼");
                });

                // 將驗證碼和用戶資料存入 Cache，持續 10 分鐘
                $userData = [
                    'account' => $request->forgotAccount,
                    'email' => $email,
                    'verifyCode' => $verifyCode
                ];
                Cache::put('user_forgot_password_' . $email, $userData, 600);

                return redirect()->back()->with([
                    'forgotExist' => true,
                    'forgotMessage' => '驗證碼已發送到您的email',
                    'forgotEmail' => $email,
                    'forgotAccount' => $account
                ]);
            } catch (\Exception $e) {
                // 紀錄錯誤日誌
                \Log::error('忘記密碼的驗證碼發送失敗: ' . $e->getMessage());

                return redirect()->back()->with([
                    'forgotExist' => false,
                    'forgotMessage' => '驗證碼發送失敗，請重試'
                ]);
            }
        } else {
            return redirect()->back()->with([
                'forgotExist' => false,
                'forgotMessage' => '未找到用戶資料'
            ]);
        }
    }
    public function forgot_2(Request $request)
    {
        

        
    }
}
