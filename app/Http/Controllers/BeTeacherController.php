<?php

namespace App\Http\Controllers;
use App\Models\BeTeacher;
use Illuminate\Http\Request;
use App\Models\City;
use App\Models\District;
use App\Models\Subject;

class BeTeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function create()
    {
        $cities = City::all();
        $subjects = Subject::all();
        return view('beteacher', compact('cities', 'subjects'));
    }

    public function store(Request $request)
{
    $validatedData = $request->validate([
        'title' => 'required|string|max:255',
        'subject_id' => 'required|exists:subject,id',
        'available_time' => 'required|array',
        'hourly_rate' => 'required|numeric|min:0',
        'city_id' => 'required|exists:cities,id',
        'districts' => 'required|array',
        'districts.*' => 'exists:districts,id',
        'details' => 'required|string',
    ]);

    $validatedData['available_time'] = json_encode($validatedData['available_time']);
    $validatedData['district_ids'] = json_encode($validatedData['districts']);
    $validatedData['user_id'] = auth()->id();

    // 移除 districts，因為它不是表的直接列
    unset($validatedData['districts']);

    $beTeacher = BeTeacher::create($validatedData);

    return response()->json(['message' => '老師資料已成功提交！'], 201);
}

    public function getCities()
    {
        $cities = City::all();
        return response()->json($cities);
    }

    public function getDistricts($cityId)
    {
        $districts = District::where('city_id', $cityId)->get();
        return response()->json($districts);
    }

    public function getSubjects()
    {
        $subjects = Subject::all();
        return response()->json($subjects);
    }
}
