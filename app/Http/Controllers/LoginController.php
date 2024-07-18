<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function checkUser(Request $request)
    {
        $username = $request->input('loginUsername');
        $password = $request->input('loginPassword');

  
        $user = DB::table('users')
                  ->where('name', $username)
                  ->where('password', $password)
                  ->first();

        if ($user) {
            return redirect()->back()->with('message', '是');
        } else {
            return redirect()->back()->with('message', '否');
        }

    }
}