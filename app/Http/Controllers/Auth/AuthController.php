<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

// ↓↓↓↓↓ email專用
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cache;

class AuthController extends Controller
{
    public function sendEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
        ]);

        $verifyCode = rand(100000, 999999);
        $goalEamil = $request->email;

        try {
            Mail::raw("您的驗證碼是 $verifyCode", function ($message) use ($goalEamil) {
                $message->to($goalEamil)
                    ->subject("LeanLink家教平台驗證碼");
            });

            // 將驗證碼存入 Cache，持續 10 分鐘
            Cache::put('vericode' . $goalEamil, $verifyCode, 600);

            return response()->json(['success' => true, 'message' => '驗證碼已發送']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => '發送失敗，請重試'], 500);
        }
    }

    public function register(Request $request)
    {
        $registerInfo = $request->validate([
            'registerAccount' => [
                'required',
                'regex:/^[a-z0-9._@-]+$/',
                'min:4',
                'max:20',
            ],
            'registerName' => 'required',
            'registerPassword' => [
                'required',
                'string',
                'min:8',
                'max:30',
                'confirmed',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,30}$/',
            ],
            'email' => 'required|email',
            'verification_code' => 'required',
        ]);
        $goalEmail = $registerInfo['email'];
        $inputVerifyCode = $registerInfo['verification_code'];

        $sentVerifyCode = Cache::get('vericode' . $goalEmail);
        if ($inputVerifyCode === $sentVerifyCode) {
            return response()->json(['success' => true, 'message' => '驗證成功']);
        } else {
            return response()->json(['success' => false, 'message' => '驗證碼錯誤或過期'], 422);
        }


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
