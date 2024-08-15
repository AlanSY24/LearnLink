<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Calendar;
use App\Models\TeacherCalendar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\BeTeacher;


class OtherCalendarController extends Controller
{
    // public function index(Request $request)
    // {
    //     // 模擬從其他頁面接收到的教師ID
    //     // $simulatedStudentId = '12345'; // 這裡使用一個固定的值來模擬

    //     // 在實際情況下，您會從請求中獲取教師ID
    //     // $teacherUserId = $request->input('teacher_id');

    //     // 使用模擬的教師ID
    //     // $studentUserId = $simulatedStudentId;

    //     return view('OtherCalendar', compact('studentUserId'));
    // }


    public function storeEvent(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'date' => 'required|date',
                'time' => 'required',
                'text' => 'required|string',
                'city' => 'required|string',
                'district' => 'required|string',
                'detail_address' => 'required|string',
                'hourly_rate' => 'required|numeric',
            ]);

            // $externalUserId = $request->input('user_id'); // 從請求中獲取外部 user_id
            $loggedInUserId = Auth::id(); // 獲取當前登入用戶的 ID

            if (!$loggedInUserId) {
                return response()->json(['error' => '用戶未登入'], 401);
            }

            if (!$studentId) {
                return response()->json(['error' => '未提供學生用戶 ID'], 400);
            }

            DB::beginTransaction();

            // 儲存到 Calendar 模型，使用登入用戶的 ID
            $calendarData = array_merge($validatedData, ['user_id' => $loggedInUserId]);
            $calendar = TeacherCalendar::create($calendarData);

            // 同時儲存到 TeacherCalendar 模型，使用外部傳入的 user_id
            $studentrCalendarData = array_merge($validatedData, ['student_id' => $studentId]);
            Calendar::create($studentrCalendarData);

            DB::commit();

            return response()->json(['message' => '事件已成功儲存到兩個資料表', 'id' => $calendar->id]);
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Error in storeEvent: ' . $e->getMessage());
            return response()->json(['error' => '服務器錯誤，請稍後再試'], 500);
        }
    }

    public function deleteEvent($id)
    {
        try {
            DB::beginTransaction();

            $event = Calendar::findOrFail($id);
            
            // 從 Calendar 資料表中刪除事件
            $event->delete();

            // 同時從 TeacherCalendar 資料表中刪除對應事件
            TeacherCalendar::where([
                'date' => $event->date,
                'time' => $event->time,
                'user_id' => $event->user_id
            ])->delete();

            DB::commit();

            return response()->json(['message' => '事件已從兩個資料表中刪除'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Error in deleteEvent: ' . $e->getMessage());
            return response()->json(['error' => '刪除事件時發生錯誤'], 500);
        }
    }

    public function submitEvents(Request $request)
    {
        try {
            $events = $request->input('events');
            $studentId = $request->input('student_id'); // 從請求中獲取外部 user_id
            $beTeacherId = $request->input('beTeacherId');
            $loggedInUserId = Auth::id(); // 獲取當前登入用戶的 ID

            if (!$loggedInUserId) {
                return response()->json(['error' => '用戶未登入'], 401);
            }

            $beTeacher = BeTeacher::find($beTeacherId);
        if (!$beTeacher) {
            return response()->json(['error' => '找不到指定的 BeTeacher'], 404);
        }

            // if (!$externalUserId) {
            //     return response()->json(['error' => '未提供教師用戶 ID'], 400);
            // }

            DB::beginTransaction();
            
            foreach ($events as $eventData) {
                $validatedData = $this->validateEvent($eventData);
                
                // 創建 TeacherCalendar 條目，使用登入用戶的 ID
                $calendarData = array_merge($validatedData, ['user_id' => $loggedInUserId]);
                TeacherCalendar::create($calendarData);
                
                // 創建 Calendar 條目，使用外部傳入的 user_id
                $studentrCalendarData = array_merge($validatedData, ['user_id' => $studentId]);
               Calendar::create($studentrCalendarData);
            }
            $beTeacher->status = 'in_progress' ;
            $beTeacher->save();
            
            DB::commit();

            return response()->json(['success' => true, 'message' => '所有事件已成功保存到兩個資料表']);
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Error in submitEvents: ' . $e->getMessage());
            return response()->json(['error' => '服務器錯誤，請稍後再試'], 500);
        }
    }

    private function validateEvent($eventData)
    {
        return validator($eventData, [
            'date' => 'required|date',
            'time' => 'required',
            'text' => 'required|string',
            'city' => 'required|string',
            'district' => 'required|string',
            'detail_address' => 'required|string',
            'hourly_rate' => 'required|numeric',
        ])->validate();
    }

    public function showEvents()
    {
        $loggedInUserId = Auth::id();
        
        if (!$loggedInUserId) {
            return response()->json(['error' => '用戶未登入'], 401);
        }

        // 獲取當前登入用戶的 Calendar 事件
        // $calendarEvents = Calendar::where('user_id', $loggedInUserId)->get();

        // 獲取與當前用戶相關的 TeacherCalendar 事件
        $teacherCalendarEvents = TeacherCalendar::where('user_id', $loggedInUserId)->get();

        $events = $calendarEvents->concat($teacherCalendarEvents);

        return view('show-events', compact('events'));
    }

    public function show(Request $request)
    {
        // 模擬從其他頁面接收到的教師ID
        // $simulatedTeacherId = '12345'; // 這裡使用一個固定的值來模擬

        // 在實際情況下，您會從請求中獲取教師ID
        // $teacherUserId = $request->input('teacher_id');

        // 使用模擬的教師ID
        // $teacherUserId = $simulatedTeacherId;

        $userId = $request->query('user_id');
        $beTeacherId = $request->query('beTeacherId');

        $studentUserId = User::findOrFail($userId)->id;
        $beTeacher = BeTeacher::select('id', 'title', 'status')->findOrFail($beTeacherId);

        return view('OtherCalendar', compact('studentUserId', 'beTeacher'));
    }
}