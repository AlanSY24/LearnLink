<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;

class SubjectController extends Controller
{
    public function index(Request $request)
    {
        $subjects = Subject::all();

        // 根據路由參數來區分要顯示的視圖
        if ($request->routeIs('teacher_lists')) {
            return view('teacher_lists', compact('subjects'));
        } elseif ($request->routeIs('student_cases')) {
            return view('student_cases', compact('subjects'));
        }

        // 預設返回一個視圖或者其他邏輯處理
        return view('default_view', compact('subjects'));
    }
}