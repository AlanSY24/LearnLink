<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentPage;

class StudentPageController extends Controller
{
    public function index()
    {
        $students = StudentPage::all();
        return view('studentpage', compact('students'));
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:1',
            'gender' => 'required|in:Male,Female',
        ]);

        $student = new StudentPage();
        $student->name = $request->name;
        $student->age = $request->age;
        $student->gender = $request->gender;
        $student->save();

        return redirect()->route('studentpage')->with('success', '學生資料已成功儲存！');
    }
}
