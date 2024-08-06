<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\District;
use App\Models\TeacherRequest;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
 
    
    
    
    public function storeRequest(Request $request)
{
    try {
        \Log::info('Received request data:', $request->all());

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'subject_id' => 'required|exists:subject,id',
            'available_time' => 'required|array',
            'expected_date' => 'required|date',
            'hourly_rate_min' => 'required|integer|min:0',
            'hourly_rate_max' => 'required|integer|gte:hourly_rate_min',
            'city_id' => 'required|exists:cities,id',
            'districts' => 'required|array',
            'details' => 'required|string',
            
        ]);
        $validatedData['user_id'] = auth()->id();
        // 將 districts 轉換為 JSON 字符串並存儲到 district_ids
        $validatedData['district_ids'] = json_encode($validatedData['districts']);
        unset($validatedData['districts']);

        // 確保 available_time 也被轉換為 JSON 字符串
        $validatedData['available_time'] = json_encode($validatedData['available_time']);

        // 設置初始狀態為"發布中"
        $validatedData['status'] = TeacherRequest::STATUS_PUBLISHED;

        \Log::info('Validated and processed data:', $validatedData);

        $teacherRequest = TeacherRequest::create($validatedData);

        return response()->json(['message' => '請求已成功儲存', 'id' => $teacherRequest->id]);
    } catch (\Illuminate\Validation\ValidationException $e) {
        \Log::error('Validation failed: ' . json_encode($e->errors()));
        return response()->json(['error' => $e->errors()], 422);
    } catch (\Exception $e) {
        \Log::error('Error in storeRequest: ' . $e->getMessage());
        \Log::error($e->getTraceAsString());
        return response()->json(['error' => '服務器錯誤，請稍後再試'], 500);
    }
}
}