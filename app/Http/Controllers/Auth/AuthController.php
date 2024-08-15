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