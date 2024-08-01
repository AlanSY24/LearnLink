<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // 調用記錄註冊方法
        \Log::info('Register method called');
        // 記錄所有請求數據
        \Log::info($request->all());

        // 驗證請求數據
        $request->validate([
            'username' => 'required|unique:users,account', // 確認在users表的account欄位中唯一
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:8',
            'confirm_password' => 'required|same:password',
        ]);

        // 記錄驗證通過
        \Log::info('Validation passed');

        try {
            $user = User::create([
                'account' => $request->username,
                'name' => $request->name,
                'password' => Hash::make($request->password),
            ]);

            \Log::info('User created', ['user' => $user]);

            Auth::login($user);

            return redirect('/auth_status')->with('success', '註冊成功！');

        } catch (\Exception $e) {

            \Log::error('User creation failed', ['error' => $e->getMessage()]);
            return back()->withErrors(['msg' => '註冊失敗']);
        }
    }

    public function login(Request $request)
    {
        $loginEntered = $request->validate([
            'loginAccount' => 'required',
            'loginPassword' => 'required',
        ]);
        /* ↑↑↑↑↑↑執行之後
        $loginEntered 會變成
        [   'loginAccount' => '輸入的帳號',
            'loginPassword' => '輸入的密碼' ]; */

        if (Auth::attempt(['account' => $loginEntered['loginAccount'], 'password' => $loginEntered['loginPassword']])) {

            $request->session()->regenerate();

            return redirect()->route('auth.status'); // 登入成功後跳到 /auth_status

        }

        // 如果認證失敗，返回錯誤信息
        return back()->withErrors([
            'loginAccount' => '帳號或密碼錯誤',
        ])->onlyInput('loginAccount');
    }

}

// 註釋掉原來的重定向代碼
// return redirect()->intended('/homePage')->with('success', '登入成功！');
// return back()->withErrors([...])

// back() 方法返回上一頁的重定向響應。
// withErrors([...]) 方法將錯誤信息存儲在會話中，以便在下一次請求中顯示。
// ['loginUsername' => '帳號或密碼錯誤'] 傳入一個包含錯誤信息的數組，鍵為欄位名稱，值為錯誤消息。
// ->onlyInput('loginUsername')

// onlyInput('loginUsername') 方法確保在重定向回上一頁時，只有 loginUsername 欄位的輸入值被保留。
// 這樣用戶只需重新輸入密碼，而不需要再次輸入用戶名。