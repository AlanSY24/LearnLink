<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentProfile;
use Illuminate\Support\Facades\Auth;

class StudentProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $profile = StudentProfile::where('user_id', $user->id)->first();
        return view('studentprofile', compact('profile'));
    }
    public function edit()
    {
        $user = Auth::user();
        $profile = StudentProfile::where('user_id', $user->id)->first();
        return view('studentprofile', compact('profile'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'education' => 'required|string',
            'introduction' => 'required|string',
        ]);

        $user = Auth::user();
        $profile = StudentProfile::updateOrCreate(
            ['user_id' => $user->id],
            [
                'education' => $request->education,
                'introduction' => $request->introduction,
            ]
        );

        return redirect()->route('studentprofile')->with('success', '資料已成功儲存！');
    }
}
