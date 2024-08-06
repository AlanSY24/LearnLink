<?php

namespace App\Http\Controllers;

use App\Models\GetStudent;
use Illuminate\Http\Request;

class GetStudentController extends Controller
{
    /**
     * 顯示所有教師資料
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $teachers = GetStudent::with('subject')->get(); // 取出所有教師連同科目資料
        return view('student_cases', compact('students'));
    }
}
