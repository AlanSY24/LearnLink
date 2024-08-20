<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class EmailController extends Controller
{
    public function sendEmail(Request $request)
    {
        $verifyCode = rand(100000, 999999);
        $email = $request->email;
        $account = $request->account;
        $name = $request->name;
        $password = $request->password;
        $password_confirmation = $request->password_confirmation;
        $gender = $request->gender;

        // 如果只有email，就是忘記密碼的情況
        if ($request->only('email') == $request->all()) {
            // 這是忘記密碼的情況
            $subject = "重設密碼驗證碼";
            $message = "您的重設密碼驗證碼是 $verifyCode";
            try {
                Mail::raw($message, function ($message) use ($email, $subject) {
                    $message->to($email)
                        ->subject($subject);
                });

                // 將驗證碼和用戶資料存入 Cache，持續 10 分鐘
                Cache::put('something' . $email, ['verifyCode' => $verifyCode], 600);

                // 把資料存入 session
                $request->session()->put('registration_data', [
                    'email' => $email,
                    'account' => $request->account,
                    'name' => $request->name,
                    'gender' => $request->gender,
                    'password' => Hash::make($request->password) // 加密之後的密碼
                ]);

                return response()->json(['success' => true, 'message' => '重設密碼 email寄送成功']);
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => '重設密碼 email 發送失敗',
                    'error' => $e->getMessage()
                ], 500);
            }
        } else if ($account && $password && $password_confirmation && $gender && $email && $name) {
            // 有很齊全的資料，那就是註冊
            $accountExists = User::where('account', $account)->exists();
            $emailExists = User::where('email', $email)->exists();

            if ($accountExists) {
                return response()->json([
                    'success' => false,
                    'message' => '無法使用此帳號'
                ]);
            }

            if ($emailExists) {
                return response()->json([
                    'success' => false,
                    'message' => '此電子郵件已被使用'
                ]);
            }

            // account 和 email 都不存在，繼續註冊流程
            $subject = "LearnLink註冊驗證碼";
            $message = "您的註冊驗證碼是 $verifyCode";

            try {
                Mail::raw($message, function ($message) use ($email, $subject) {
                    $message->to($email)
                        ->subject($subject);
                });

                // 將驗證碼和用戶資料存入 Cache，持續 10 分鐘
                Cache::put('something' . $email, ['verifyCode' => $verifyCode], 600);

                $request->session()->put('registration_data', [
                    'email' => $email,
                    'account' => $account,
                    'name' => $name,
                    'gender' => $gender,
                    'password' => Hash::make($password)
                ]);

                return response()->json(['success' => true, 'message' => '註冊 email寄送成功']);
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => '註冊 email 發送失敗',
                    'error' => $e->getMessage()
                ], 500);
            }

        } else {
            return response()->json([
                'success' => false,
                'message' => '輸入有誤(不是註冊也不是重設)'
            ]);
        }
    }
}
