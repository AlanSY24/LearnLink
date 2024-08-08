<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\GetTeacher;
use App\Models\Subject;

class GetTeacherController extends Controller
{
    /**
     * 顯示所有教師資料
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // 取得所有科目
        $subjects = Subject::select('id', 'name')->get();

        // 取得所有城市
        $cities = City::select('id', 'city')->get();

        // 取得所有教師資料
        $teachers = GetTeacher::with('subject', 'city', 'user')->get();

        // 使用 compact 將變量名改為 'teachers', 'subjects', 'cities'
        return view('teacher_lists', compact('teachers', 'subjects', 'cities'));
    }
}
