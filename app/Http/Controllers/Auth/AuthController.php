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
    public function forgot(Request $request)
    {
        $request->validate([
            'forgotAccount' => 'required',
            'forgotEmail' => 'required|email',
        ]);

        // 查詢資料表中是否有匹配的帳號和電子郵件
        $user = User::where('account', $request->forgotAccount)
            ->where('email', $request->forgotEmail)
            ->first();
        /*找出'account'欄位中跟forgotAccount相等的資料(可能不只一筆，也可能沒有)
        然後在這些篩選過的資料中找出'email'欄位跟forgotEmail的資料(也可能不只一筆，也可能沒有)，
        然後在篩選過量次的資料中取第一筆，將其回傳給$user，若沒有則返回null。*/

        if ($user) {
            $verifyCode = rand(100000, 999999);
            $email = $request->forgotEmail;
            $account = $request->forgotAccount;



            try {
                // 發送email
                Mail::raw("您的驗證碼是 $verifyCode", function ($message) use ($email) {
                    $message->to($email)
                        ->subject("LeanLink家教平台重設密碼驗證碼");
                });

                // 將驗證碼和用戶資料存入 Cache，持續 10 分鐘
                $userData = [
                    'account' => $request->forgotAccount,
                    'email' => $email,
                    'verifyCode' => $verifyCode
                ];
                Cache::put('user_forgot_password_' . $email, $userData, 600);

                return redirect()->back()->with([
                    'forgotExist' => true,
                    'forgotMessage' => '驗證碼已發送到您的email',
                    'forgotEmail' => $email,
                    'forgotAccount' => $account
                ]);
            } catch (\Exception $e) {
                // 紀錄錯誤日誌
                \Log::error('忘記密碼的驗證碼發送失敗: ' . $e->getMessage());

                return redirect()->back()->with([
                    'forgotExist' => false,
                    'forgotMessage' => '驗證碼發送失敗，請重試'
                ]);
            }
        } else {
            return redirect()->back()->with([
                'forgotExist' => false,
                'forgotMessage' => '未找到用戶資料'
            ]);
        }
    }
    public function forgot_2(Request $request)
    {
        $request->validate([
            'forgot_2_email' => 'required|email',
            'fotget_2_code' => 'required',
            'forgot_2_account' => 'required',
        ]);

        $email = $request->input('forgot_2_email'); 
        $account = $request->input('forgot_2_account'); 
        $inputVerifyCode = $request->input('fotget_2_code'); 

        $cachedData = Cache::get('user_forgot_password_' . $email);

        if (!$cachedData) {
            return redirect()->back()->with([
                'forgotExist_2' => false,
                'forgotMessage_2' => '驗證碼已過期或不存在，請重新發送'
            ]);
        }

        // 比對驗證碼
        if ($inputVerifyCode == $cachedData['verifyCode']) {
            // 驗證碼匹配

            // 清除 Cache 中的數據
            Cache::forget('user_forgot_password_' . $email);

            return redirect()->route('reset')->with([
                'forgotExist_2' => true,
                'forgotMessage_2' => '驗證成功，請重設密碼',
                'forgotEmail_2' => $email, // 傳遞 email 到下一個頁面
                'forgotAccount_2' => $account // 傳遞 account 到下一個頁面
            ]);
        } else {
            // 驗證碼不匹配
            return redirect()->back()->with([
                'forgotExist_2' => false,
                'forgotMessage_2' => '驗證碼不正確，請重試'
            ]);
        }
    }
    public function forgot_3(Request $request)
    {

    }
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

        $messages = [
            'registerName.required' => '請填寫姓名。',
            'registerEmail.required' => '請填寫電子郵件。',
            'registerEmail.email' => '電子郵件格式不正確。',
            'registerEmail.unique' => '電子郵件已被使用。',
            'registerPassword.required' => '請填寫密碼。',
            'registerPassword.regex' => '密碼必須包含至少一個大寫字母、一個小寫字母和一個數字。',
            'registerAccount.required' => '請填寫帳號。',
            'registerAccount.unique' => '帳號已被使用。',
            'registerGender.required' => '請選擇性別。',
            'registerGender.in' => '性別選擇無效。',
        ];

        // 執行驗證
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // ↓ ↓ ↓ ↓ ↓ 生成驗證碼並寄出email
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
            // 紀錄錯誤日誌
            \Log::error('Email 發送失敗: ' . $e->getMessage());

            // 返回詳細錯誤信息
            return response()->json([
                'success' => false,
                'message' => 'email 發送失敗，請重試',
                'error' => $e->getMessage() // 可以選擇性提供更多錯誤信息
            ], 500);
        }
    }
    public function register(Request $request)
    {
        $email = $request->email;
        $verifyCode = $request->verificationCode; // 確保這與前端一致

        // 從 Cache 中獲取用戶資料
        $userData = Cache::get('user_registration_' . $email);

        if (!$userData) {
            return response()->json([
                'success' => false,
                'message' => '驗證碼已過期或無效，請重新發送驗證碼'
            ], 422);
        }

        if ($userData['verifyCode'] != $verifyCode) {
            return response()->json([
                'success' => false,
                'message' => '驗證碼不正確'
            ], 422);
        }

        try {
            // 註冊新帳號，將資料加入資料庫
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
            return response()->json([
                'success' => true,
                'message' => '註冊成功'
            ], 201);

        } catch (\Exception $e) {
            // 紀錄錯誤日誌
            \Log::error('註冊過程中發生錯誤: ' . $e->getMessage());

            // 返回詳細錯誤信息
            return response()->json([
                'success' => false,
                'message' => '註冊過程中發生錯誤，請稍後再試。',
                'error' => $e->getMessage() // 可以再增加更多詳細
            ], 500);
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