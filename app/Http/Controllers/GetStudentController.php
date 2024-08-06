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
        $students = GetStudent::all(); 
        return view('student_cases', compact('students'));
    }
}
