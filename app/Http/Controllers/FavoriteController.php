<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TeacherRequest;

class FavoriteController extends Controller
{
    public function index()
    {
        // 獲取所有教師請求
        $teacherRequests = TeacherRequest::with(['subject', 'city'])->get();
        
        // 傳遞教師請求數據到視圖
        return view('teacher_requests', compact('teacherRequests'));
    }

    public function store(Request $request, $teacherRequestId)
    {
        $user = $request->user();
        $teacherRequest = TeacherRequest::findOrFail($teacherRequestId);

        if ($user->favoriteTeacherRequests()->where('teacher_request_id', $teacherRequestId)->exists()) {
            $user->favoriteTeacherRequests()->detach($teacherRequestId);
            $favorited = false;
        } else {
            $user->favoriteTeacherRequests()->attach($teacherRequestId);
            $favorited = true;
        }

        return response()->json(['favorited' => $favorited]);
    }

    public function destroy(Request $request, $teacherRequestId)
    {
        $user = $request->user();
        $teacherRequest = TeacherRequest::findOrFail($teacherRequestId);

        $user->favoriteTeacherRequests()->detach($teacherRequestId);

        return response()->json(['favorited' => false]);
    }
}
?>