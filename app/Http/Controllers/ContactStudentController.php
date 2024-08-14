<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactStudent;
use App\Models\TeacherRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;



class ContactStudentController extends Controller
{
    //
    public function contactStudent(Request $request)
    {
        // 驗證請求資料
        $validated = $request->validate([
            'teacher_requests_id' => 'required|exists:teacher_requests,id',
        ]);
        // 獲取已登入使用者的 ID
        $userId = Auth::id();

            // 檢查是否已經存在聯絡記錄
        $existingContact = ContactStudent::where('teacher_requests_id', $validated['teacher_requests_id'])
        ->where('user_id', $userId)
        ->first();

        if ($existingContact) {
        return response()->json(['message' => '您已經聯絡過這位老師了。'], 400);
        }


        // 建立新的聯絡紀錄
        $contact = ContactStudent::create([
            'teacher_requests_id' => $validated['teacher_requests_id'],
            'user_id' => $userId, // 使用已登入使用者的 ID
        ]);

        return response()->json(['message' => '聯絡成功', 'contact' => $contact], 201);
    }

    public function checkContactStatus(Request $request)
    {
        $validated = $request->validate([
            'teacher_requests_id' => 'required|exists:teacher_requests,id',
        ]);
    
        $userId = Auth::id();
    
        $exists = ContactStudent::where('teacher_requests_id', $validated['teacher_requests_id'])
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
        $contacts = ContactStudent::where('user_id', $userId)->get();

        return response()->json($contacts);
    }
}
