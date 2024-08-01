<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\District;
use App\Models\TeacherRequest;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
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
    }
}