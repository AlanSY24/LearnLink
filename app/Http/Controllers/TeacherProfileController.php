<?php
// 老師履歷表
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TeacherProfile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TeacherProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $profile = TeacherProfile::where('user_id', $user->id)->first();

        return view('teacherprofile', compact('profile'));
    }

    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'pdf' => 'nullable|mimes:pdf|max:2048',
    ]);

    $user = Auth::user();
    
    // 讀取檔案內容
    $photo = $request->file('photo') ? file_get_contents($request->file('photo')) : null;
    $pdf = $request->file('pdf') ? file_get_contents($request->file('pdf')) : null;

    $profile = TeacherProfile::updateOrCreate(
        ['user_id' => $user->id],
        [
            'title' => $request->title,
            'photo' => $photo,
            'pdf' => $pdf,
        ]
    );

    return redirect()->route('teacherprofile.index')->with('success', '履歷表已成功儲存！');
}

}
