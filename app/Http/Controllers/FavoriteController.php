<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\TeacherRequest;

class FavoriteController extends Controller
{
    public function index()
    {
        // 獲取所有教師請求以及相關的 subject 和 city 資料
        $teacherRequests = TeacherRequest::with(['subject', 'city'])->get();
        // dd($teacherRequests);
        // 傳遞教師請求數據到視圖
        return view('teacher_requests', compact('teacherRequests'));
    }

    public function store(Request $request, $teacherRequestId)
    {
        $user = $request->user();
        $teacherRequest = TeacherRequest::findOrFail($teacherRequestId);

        $favorite = Favorite::where('user_id', $user->id)
                            ->where('teacher_request_id', $teacherRequestId)
                            ->first();

        if ($favorite) {
            // 如果已存在收藏，則刪除
            $favorite->delete();
            $favorited = false;
        } else {
            // 如果不存在收藏，則添加
            Favorite::create([
                'user_id' => $user->id,
                'teacher_request_id' => $teacherRequestId,
            ]);
            $favorited = true;
        }

        return response()->json(['favorited' => $favorited]);
    }

    public function destroy(Request $request, $teacherRequestId)
    {
        $user = $request->user();

        Favorite::where('user_id', $user->id)
                ->where('teacher_request_id', $teacherRequestId)
                ->delete();

        return response()->json(['favorited' => false]);
    }
}
?>