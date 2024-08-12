<?php
// 老師履歷表
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TeacherProfile;
use App\Models\TeacherRequest;
use App\Models\Favorite;
use App\Models\Subject;
use App\Models\User;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TeacherProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $profile = TeacherProfile::where('user_id', $user->id)->first();
        $favorites = Favorite::where('user_id', $user->id)->get();
        
        $favorites_array= array();
        $i=0;
        foreach( $favorites as $item){
            //標題
            $request_id = $item->teacher_request_id;
            $teacher_request_item = TeacherRequest::where([
                ['user_id', '=', $user->id],
                ['id', '=', $request_id]
            ])->first(); 

            //科目
            $subject_id = $teacher_request_item->subject_id;
            $subject = Subject::where([
                ['id', '=', $subject_id],
            ])->first();

            //姓名
            $User_name = $user->name;
            //性別
            $User_gender = $user->gender;
        

            $favorite_array =array(
                //標題
                "title"=>$teacher_request_item->title,
                //科目
                "subjectname"=>$subject->name,
                //姓名
                "name"=>$User_name,
                //性別
                "gender"=>$User_gender,



            );
            array_push($favorites_array,$favorite_array);
        }

        return view('teacherprofile', compact('profile','favorites_array'));
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
