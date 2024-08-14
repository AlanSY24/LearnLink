<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ContactTeacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactTeacherController extends Controller
{
    //
    public function contactTeacher(Request $request)
    {
        // 驗證請求資料
        $validated = $request->validate([
            'be_teacher_id' => 'required|exists:be_teachers,id',
        ]);
        // 獲取已登入使用者的 ID
        $userId = Auth::id();

            // 檢查是否已經存在聯絡記錄
        $existingContact = ContactTeacher::where('be_teacher_id', $validated['be_teacher_id'])
        ->where('user_id', $userId)
        ->first();

        if ($existingContact) {
        return response()->json(['message' => '您已經聯絡過這位老師了。'], 400);
        }


        // 建立新的聯絡紀錄
        $contact = ContactTeacher::create([
            'be_teacher_id' => $validated['be_teacher_id'],
            'user_id' => $userId, // 使用已登入使用者的 ID
        ]);

        return response()->json(['message' => '聯絡成功', 'contact' => $contact], 201);
    }

    public function checkContactStatus(Request $request)
    {
        $validated = $request->validate([
            'be_teacher_id' => 'required|exists:be_teachers,id',
        ]);
    
        $userId = Auth::id();
    
        $exists = ContactTeacher::where('be_teacher_id', $validated['be_teacher_id'])
                                ->where('user_id', $userId)
                                ->exists();
    
        return response()->json(['exists' => $exists]);
    }

        /**
     * 獲取使用者聯絡過的所有教師
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getMyContacts()
    {
        // 獲取已登入使用者的 ID
        $userId = Auth::id();

        // 獲取使用者聯絡過的所有教師
        $contacts = ContactTeacher::where('user_id', $userId)->get();

        return response()->json($contacts);
    }
}
