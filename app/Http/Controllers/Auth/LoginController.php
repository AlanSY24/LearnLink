<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
{
    $loginEntered = $request->validate([
        'loginAccount' => 'required',
        'loginPassword' => 'required',
    ]);

    if (Auth::attempt(['account' => $loginEntered['loginAccount'], 'password' => $loginEntered['loginPassword']])) {
        $request->session()->regenerate();

        if ($request->ajax()) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('homePage');
    }

    if ($request->ajax()) {
        return response()->json(['error' => '帳號或密碼錯誤'], 401);
    }

    return back()->withErrors([
        'error' => '帳號或密碼錯誤',
    ])->withInput($request->only('loginAccount'));
}
}
