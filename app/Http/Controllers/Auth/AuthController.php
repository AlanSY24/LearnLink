<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;


class AuthController extends Controller
{
    public function register(Request $request)
    {
        // 定義驗證規則
        $rules = [
            'registerName' => 'required|string|max:30',
            'registerEmail' => 'required|string|email|max:255',
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
            ],
            'registerGender' => 'required|in:1,2,3',
        ];

        // 執行驗證
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // 檢查 email 和 account 是否已存在
        $emailExists = User::where('email', $request->registerEmail)->exists();
        $accountExists = User::where('account', $request->registerAccount)->exists();

        if ($emailExists) {
            return response()->json(['error' => '此電子郵件已被使用'], 422);
        }

        if ($accountExists) {
            return response()->json(['error' => '此帳號已被使用'], 422);
        }

        // 創建新用戶，但不保存到數據庫
        $user = new User([
            'name' => $request->registerName,
            'email' => $request->registerEmail,
            'password' => Hash::make($request->registerPassword),
            'account' => $request->registerAccount,
            'gender' => $request->registerGender,
        ]);

        // 觸發 Registered 事件，這會發送驗證郵件
        event(new Registered($user));

        // 保存用戶到數據庫
        $user->save();

        // 返回成功響應
        return response()->json(['message' => '註冊成功，請檢查您的郵箱進行驗證'], 201);
    }


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
