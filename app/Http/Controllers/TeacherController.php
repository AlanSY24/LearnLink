<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
use App\Models\Teacher;
=======
use App\Models\City;
use App\Models\District;
use App\Models\TeacherRequest;
>>>>>>> 51e465dcfcc85e3217274027b7ae07c0abf18374
use Illuminate\Http\Request;

class TeacherController extends Controller
{
<<<<<<< HEAD
    /**
     * Search for teachers based on request parameters.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(Request $request)
    {
        // 构建查询
        $query = Teacher::with('user'); // 加载用户关系

        // 根据请求参数筛选数据
        if ($request->has('subject') && $request->subject != 0) {
            $query->where('subject', $request->subject);
        }

        if ($request->has('minBudget') && $request->has('maxBudget')) {
            $query->whereBetween('min_price', [$request->minBudget, $request->maxBudget])
                  ->whereBetween('max_price', [$request->minBudget, $request->maxBudget]);
        }

        if ($request->has('city')) {
            $query->where('city', $request->city);
        }

        if ($request->has('district')) {
            $query->where('district', $request->district);
        }

        if ($request->has('time')) {
            $query->where('time', $request->time);
        }

        // 执行查询并获取结果
        $teachers = $query->get();

        // 返回 JSON 响应
        return response()->json(['teachers' => $teachers]);
=======
    public function getCities()
    {
        return City::all();
    }

    public function getDistricts($cityId)
    {
        return District::where('city_id', $cityId)->get();
    }

    public function storeRequest(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'subject' => 'required|string',
            'available_time' => 'required|array',
            'expected_date' => 'required|date',
            'hourly_rate_min' => 'required|integer|min:0',
            'hourly_rate_max' => 'required|integer|gte:hourly_rate_min',
            'city' => 'required|exists:cities,id',
            'districts' => 'required|array',
            'details' => 'required|string',
        ]);

        $teacherRequest = TeacherRequest::create([
            'title' => $validatedData['title'],
            'subject' => $validatedData['subject'],
            'available_time' => $validatedData['available_time'],
            'expected_date' => $validatedData['expected_date'],
            'hourly_rate_min' => $validatedData['hourly_rate_min'],
            'hourly_rate_max' => $validatedData['hourly_rate_max'],
            'city_id' => $validatedData['city'],
            'district_ids' => $validatedData['districts'],
            'details' => $validatedData['details'],
        ]);

        return response()->json(['message' => '請求已成功儲存', 'id' => $teacherRequest->id]);
>>>>>>> 51e465dcfcc85e3217274027b7ae07c0abf18374
    }
}