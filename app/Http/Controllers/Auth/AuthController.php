<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
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

            return redirect('/home')->with('success', '註冊成功！');

        } catch (\Exception $e) {

            \Log::error('User creation failed', ['error' => $e->getMessage()]);
            return back()->withErrors(['msg' => '註冊失敗，請稍後再試。']);
        }
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'loginUsername' => 'required', 
            'loginPassword' => 'required', 
        ]);

        if (Auth::attempt(['account' => $credentials['loginUsername'], 'password' => $credentials['loginPassword']])) {
            $request->session()->regenerate();

            $user = Auth::user();

            return response()->json([
                'success' => true,
                'message' => '登入成功！',
                'account' => $user->account,
                'name' => $user->name
            ]);

        }

        // 如果認證失敗，返回錯誤信息
        return back()->withErrors([
            'loginUsername' => '提供的憑證不匹配我們的記錄。',
        ])->onlyInput('loginUsername');
    }
}

// 註釋掉原來的重定向代碼
// return redirect()->intended('/homePage')->with('success', '登入成功！');