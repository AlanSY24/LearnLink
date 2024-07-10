<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FindTeacher;



class FindTeacherController extends Controller
{
    public function findteacher(Request $request) {
        // 数据验证
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'frequency' => 'required|string',
            'hourly_rate_min' => 'required|numeric|min:0',
            'hourly_rate_max' => 'required|numeric|min:0',
            'city' => 'required|string|max:255',
            'districts' => 'required|array',
            'details' => 'required|string',
            'connection' => 'required|string',
            'contact_value' => 'required|string',
            'available_time' => 'required|array|min:1',
            'available_time.*' => 'in:morning,afternoon,evening',
        ]);

        try {
            $findTeacher = new FindTeacher();
            $findTeacher->title = $validatedData['title'];
            $findTeacher->subject = $validatedData['subject'];
            $findTeacher->frequency = $validatedData['frequency'];
            $findTeacher->hourly_rate_min = $validatedData['hourly_rate_min'];
            $findTeacher->hourly_rate_max = $validatedData['hourly_rate_max'];
            $findTeacher->city = $validatedData['city'];
            $findTeacher->districts = json_encode($validatedData['districts']); // 将数组转换为 JSON 字符串
            $findTeacher->details = $validatedData['details'];
            $findTeacher->connection = $validatedData['connection'];
            $findTeacher->contact_value = $validatedData['contact_value'];
            $findTeacher->available_time = json_encode($validatedData['available_time']);
            $findTeacher->save();

            return redirect()->route('welcome')->with('success', '教師尋找請求已成功提交！');
        } catch (\Exception $e) {
            // 记录错误
            \Log::error('保存教师数据时出错：' . $e->getMessage());
            return redirect()->back()->with('error', '提交失敗，請稍後再試。');
        }
    }
}

// class FindTeacherController extends Controller
// {
//     function findteacher(Request $request) {
//         $title = $request->title;
//         $subject = $request->subject;
//         $frequency = $request->frequency;
//         $hourly_rate_min = $request->hourly_rate_min;
//         $hourly_rate_max = $request->hourly_rate_max;
//         $city = $request->city;
//         $details = $request->details;
//         $connection = $request->connection;
//         $contact_value = $request->contact_value;
//         $districts = $request->input('districts', []);

//         // 在這裡，你可以進行數據驗證、保存到數據庫等操作
        
//         $findTeacher = new FindTeacher();
//         $findTeacher->title = $title;
//         $findTeacher->subject = $subject;
//         $findTeacher->frequency = $frequency;
//         $findTeacher->hourly_rate_min = $hourly_rate_min;
//         $findTeacher->hourly_rate_max = $hourly_rate_max;
//         $findTeacher->city = $city;
//         $findTeacher->districts = $districtsString; // 或者使用 JSON 編碼：json_encode($districts)
//         $findTeacher->details = $details;
//         $findTeacher->connection = $connection;
//         $findTeacher->contact_value = $contact_value;
//         $findTeacher->save();
//         return redirect()->route('welcome')->with('success', '教師尋找請求已成功提交！');
//     }
// }
