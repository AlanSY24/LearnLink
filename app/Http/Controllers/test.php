<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\TeacherRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    // ... 其他方法 ...

    public function storeRequest(Request $request)
    {
        try {
            $user = Auth::user();
            \Log::info('Received request data:', $request->all());
    
            $validatedData = $request->validate([
                'subject' => 'required|string',
                'education_level' => 'required|string',
                'fee' => 'required|numeric',
                'teaching_type' => 'required|string',
                'available_time' => 'required|array',
                'city_id' => 'required|exists:cities,id',
                'districts' => 'required|array',
                'details' => 'required|string',
                'user_id' => 'required|exists:users,id',
            ]);
    
            // 將 districts 轉換為 JSON 字符串並存儲到 district_ids
            $validatedData['district_ids'] = json_encode($validatedData['districts']);
    
            // 確保 available_time 也被轉換為 JSON 字符串
            $validatedData['available_time'] = json_encode($validatedData['available_time']);
    
            \Log::info('Validated and processed data:', $validatedData);
    
            $teacherRequest = TeacherRequest::create($validatedData);

            // 可能的成功响应
            return response()->json(['message' => 'Teacher request created successfully', 'data' => $teacherRequest], 201);
        } catch (\Exception $e) {
            // 错误处理
            \Log::error('Error in storeRequest: ' . $e->getMessage());
            return response()->json(['message' => 'An error occurred while processing your request'], 500);
        }
    }

    // ... 其他方法 ...
}