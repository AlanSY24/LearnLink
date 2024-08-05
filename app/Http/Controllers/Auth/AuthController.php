<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;

class AuthController extends Controller
{
    public function preRegister(Request $request)
    {
        $rules = [
            'registerName' => 'required|string|max:30',
            'registerEmail' => 'required|string|email|max:255|unique:users,email',
            'registerPassword' => [
                'required',
                'string',
                'min:8',
                'max:30',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,30}$/'
            ],
            'registerAccount' => [
                'required',
                'string',
                'min:4',
                'max:30',
                'regex:/^[a-zA-Z0-9_.]{4,30}$/',
                'unique:users,account'
            ],
            'registerGender' => 'required|in:1,2,3',
        ];

        // 執行驗證
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // 生成驗證碼並寄出email
        $verifyCode = rand(100000, 999999);
        $email = $request->registerEmail;

        try {
            Mail::raw("您的驗證碼是 $verifyCode", function ($message) use ($email) {
                $message->to($email)
                    ->subject("LeanLink家教平台驗證碼");
            });

            // 將驗證碼和用戶資料存入 Cache，持續 10 分鐘
            $userData = $request->all();
            $userData['verifyCode'] = $verifyCode;
            Cache::put('user_registration_' . $email, $userData, 600);

            return response()->json(['success' => true, 'message' => '驗證碼已發送到您的郵箱']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => '發送失敗，請重試'], 500);
        }
    }

    public function register(Request $request)
    {
        $email = $request->email;
        $verifyCode = $request->verificationCode; // 修改這行，使其與前端一致

        $userData = Cache::get('user_registration_' . $email);

        if (!$userData || $userData['verifyCode'] != $verifyCode) {
            return response()->json(['error' => '驗證碼不正確或已過期'], 422);
        }

        // 創建新用戶
        $user = User::create([
            'name' => $userData['registerName'],
            'email' => $userData['registerEmail'],
            'password' => Hash::make($userData['registerPassword']),
            'account' => $userData['registerAccount'],
            'gender' => $userData['registerGender'],
        ]);

        // 清除緩存
        Cache::forget('user_registration_' . $email);

        // 返回成功響應
        return response()->json(['message' => '註冊成功'], 201);
    }



    public function login(Request $request)
    {
        $loginEntered = $request->validate([
            'loginAccount' => 'required',
            'loginPassword' => 'required',
        ]);
        /*  ↑↑↑↑↑↑執行之後   $loginEntered 會變成陣列:
        [   'loginAccount' => '輸入的帳號',
        'loginPassword' => '輸入的密碼' ]; */

        if (Auth::attempt(['account' => $loginEntered['loginAccount'], 'password' => $loginEntered['loginPassword']])) {

            $request->session()->regenerate();
            // ↑↑↑↑↑↑這行是為了增加安全性，本身不影響功能

            return redirect()->route('auth.status'); // 登入成功後跳到 /auth_status
            /*  redirect()跳到某一頁面
            return redirect('/auth_status')   ←←←這樣寫也可以
            不過用route()就可以指定名字
            */
        }

        // 如果認證失敗，返回錯誤信息
        return back()->withErrors([
            'error' => '帳號或密碼錯誤',
        ])->onlyInput('loginAccount');
    }

}
