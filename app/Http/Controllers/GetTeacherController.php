<?php

namespace App\Http\Controllers;

use App\Models\GetTeacher;
use Illuminate\Http\Request;

class GetTeacherController extends Controller
{
    /**
     * 顯示所有教師資料
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $teachers = GetTeacher::all(); // 取出所有教師
        return view('teacher_lists', compact('teachers'));
    }
}
