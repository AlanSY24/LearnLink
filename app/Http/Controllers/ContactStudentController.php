<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactStudent;
use App\Models\TeacherRequest;
use App\Models\BeTeacher;
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

    // 顯示特定使用者的所有 TeacherRequests 及其相關的 ContactStudents
    public function showUserTeacherRequestsWithContacts()
    {

        // 獲取已登入使用者的 ID
        $userId = Auth::id();

        // 查找指定使用者的 BeTeacher 並加載相關的 ContactStudents
        $beteacher = BeTeacher::where('CaseReceiver', $userId)
            ->where('status', 'published')
            ->with('contactTeacher.user', 'subject', 'city')
            ->get();
             // 查找指定使用者的 BeTeacher 並加載相關的 ContactStudents
        $beteacherIn_progress = BeTeacher::where('CaseReceiver', $userId)
            ->where('status', 'in_progress')
            ->with('contactTeacher.user', 'subject', 'city')
            ->get();
        // 查找指定使用者的 BeTeacher 並加載相關的 ContactStudents
        $beteacherCompleted = BeTeacher::where('CaseReceiver', $userId)
            ->where('status', 'completed')
            ->with('contactTeacher.user', 'subject', 'city')
            ->get();
        // 查找指定使用者的 BeTeacher 並加載相關的 ContactStudents
        $beteacherCancelled = BeTeacher::where('CaseReceiver', $userId)
            ->where('status', 'cancelled')
            ->with('contactTeacher.user', 'subject', 'city')
            ->get();
        // 查找指定使用者的 TeacherRequests 並加載相關的 ContactStudents
        $teacherRequests = TeacherRequest::where('user_id', $userId)
            ->where('status', 'published')
            ->with('contactStudents.user', 'subject', 'city')
            ->get();
        // 查找指定使用者的 TeacherRequests 並加載相關的 ContactStudents
        $teacherRequestsIn_progress = TeacherRequest::where('user_id', $userId)
            ->where('status', 'in_progress')
            ->with('contactStudents.user', 'subject', 'city')
            ->get();
        // 查找指定使用者的 TeacherRequests 並加載相關的 ContactStudents
        $teacherRequestsCompleted = TeacherRequest::where('user_id', $userId)
            ->where('status', 'completed')
            ->with('contactStudents.user', 'subject', 'city')
            ->get();
        // 查找指定使用者的 TeacherRequests 並加載相關的 ContactStudents
        $teacherRequestsCancelled = TeacherRequest::where('user_id', $userId)
            ->where('status', 'cancelled')
            ->with('contactStudents.user', 'subject', 'city')
            ->get();
            

        return response()->json(['teacherRequests' => $teacherRequests, 'teacherRequestsIn_progress' => $teacherRequestsIn_progress, 'teacherRequestsCancelled' => $teacherRequestsCancelled, 'teacherRequestsCompleted' => $teacherRequestsCompleted, 'beteacher' => $beteacher, 'beteacherIn_progress' => $beteacherIn_progress, 'beteacherCancelled' => $beteacherCancelled, 'beteacherCompleted' => $beteacherCompleted]);
    }

    public function remove(Request $request)
    {
        $userId = $request->input('user_id');
        $teacherRequestId = $request->input('teacher_request_id');

        // 刪除 ContactStudent 資料
        ContactStudent::where('user_id', $userId)
            ->where('teacher_requests_id', $teacherRequestId)
            ->delete();

        return response()->json(['success' => true]);
    }
    public function keepSelected(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'teacher_request_id' => 'required|exists:teacher_requests,id',
        ]);

        $teacherRequestId = $request->teacher_request_id;
        $userId = $request->user_id;

        // 获取所有与该 TeacherRequest 相关的学生联系记录
        $contactStudents = ContactStudent::where('teacher_requests_id', $teacherRequestId)->get();

        foreach ($contactStudents as $contactStudent) {
            // 如果学生ID不等于选中的学生ID，则删除该记录
            if ($contactStudent->user_id != $userId) {
                $contactStudent->delete();
            }
        }

        return response()->json(['message' => 'Only the selected student was kept']);
    }
    public function updateStatus(Request $request)
    {
        \Log::info('Request Data: ', $request->all());
        // 驗證請求
        $request->validate([
            'id' => 'required|exists:teacher_requests,id',
            'status' => 'required|in:completed,cancelled',
        ]);

        // 查找並更新 TeacherRequest
        $teacherRequest = TeacherRequest::findOrFail($request->id);
        $teacherRequest->status = $request->status;
        $teacherRequest->save();

        // 返回更新後的數據作為響應
        return response()->json([
            'title' => $teacherRequest->title,
            'status' => $teacherRequest->status,
        ]);
    }

    public function store(Request $request)
    {
        // 验证请求数据
        $validated = $request->validate([
            'teacher_requests_id' => 'required|exists:teacher_requests,id',
        ]);

        // 获取已登录用户的 ID
        $userId = Auth::id();

        // 检查是否已经存在联系记录
        $existingContact = ContactStudent::where('teacher_requests_id', $validated['teacher_requests_id'])
            ->where('user_id', $userId)
            ->first();

        if ($existingContact) {
            return response()->json(['message' => '您已經聯繫過這位學生了。'], 400);
        }

        // 创建新的联系记录
        $contact = ContactStudent::create([
            'teacher_requests_id' => $validated['teacher_requests_id'],
            'user_id' => $userId,
        ]);

        return response()->json(['message' => '聯繫成功', 'contact' => $contact], 201);
    }

}


