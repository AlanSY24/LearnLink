<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\GetStudent;
use App\Models\Subject;
use Illuminate\Http\Request;

class GetStudentController extends Controller
{
    /**
     * 顯示所有學生案件
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // 取得所有科目
        $subjects = Subject::select('id', 'name')->get();

        // 取得所有城市
        $cities = City::select('id', 'city')->get();

        // 初始化查詢
        $query = GetStudent::query();

        // 篩選科目
        if ($request->has('subject') && $request->subject != '0') {
            $query->where('subject_id', $request->subject);
        }

        // 篩選城市
        if ($request->has('city') && $request->city != '') {
            $query->where('city_id', $request->city);
        }

        // 篩選區域
        if ($request->has('district') && $request->district != '') {
            $query->whereJsonContains('district_ids', $request->district);
        }

        // 篩選預算
        if ($request->has('minBudget') && $request->has('maxBudget')) {
            $query->whereBetween('hourly_rate', [$request->minBudget, $request->maxBudget]);
        }

        // 取得所有學生資料
        $students = $query->with('subject', 'city', 'user')->get();


        // 使用 compact 將變量名改為 'teachers', 'subjects', 'cities'
        return view('student_cases', compact('students', 'subjects', 'cities'));

    }
}
