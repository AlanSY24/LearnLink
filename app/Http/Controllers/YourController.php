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
use App\Models\City;
use App\Models\District;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class YourController extends Controller
{
    public function getTeacherPhoto($studentId)
    {
        $photo = DB::table('favorites_student')
            ->join('be_teachers', 'favorites_student.be_teachers_id', '=', 'be_teachers.id')
            ->join('teacher_profiles', 'be_teachers.user_id', '=', 'teacher_profiles.user_id')
            ->where('favorites_student.user_id', $studentId)
            ->select('teacher_profiles.photo')
            ->first();
    
        if ($photo && $photo->photo) {
            return response($photo->photo)->header('Content-Type', 'image/jpeg');
        }
    
        return response()->json(['error' => 'Photo not found'], 404);
    }
}

