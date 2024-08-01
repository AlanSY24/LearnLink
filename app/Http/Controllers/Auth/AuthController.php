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
