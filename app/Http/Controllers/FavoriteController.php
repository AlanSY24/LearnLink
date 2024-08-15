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

    public function teacherFavorite()
    {
        $user = auth()->user();

        $favorites = Favorite::where('user_id', $user->id)
        ->with('teacherRequest.subject', 'teacherRequest.city',
        )
        ->get()
        ->map(function ($favorite) {
            $teacherRequest = $favorite->teacherRequest;
            // 直接使用 available_time 字段的字符串值
            $availableTime = $teacherRequest->available_time;
            $districtsIds = $favorite->teacherRequest->district_ids;
            $districts = $teacherRequest->city->districts
                ->whereIn('id', $districtsIds)
                ->pluck('district_name')
                ->toArray();
            $details = $teacherRequest->details;

            // 將性別數字轉換為文字
            $gender = '未知';
            if ($teacherRequest->user->gender === 1) {
                $gender = '先生';
            } elseif ($teacherRequest->user->gender === 2) {
                $gender = '女士';
            }
            
            return [
                'be_teacher' => [
                    'title' => $teacherRequest->title,
                    'subject' => $teacherRequest->subject->name ?? 'N/A',
                    'city' => $teacherRequest->city->city ?? 'N/A',
                    'available_time' => $availableTime,  // 保持字符串格式
                    'hourly_rate_min' => $teacherRequest->hourly_rate_min,
                    'hourly_rate_max' => $teacherRequest->hourly_rate_max,
                    'districts' => $districts,
                    'id' => $teacherRequest->id,
                    'details' => $details, 
                    
                    'expected_date' => $teacherRequest->expected_date,
                    'status' => $teacherRequest->status,
                    'name' => $teacherRequest->user->name ?? 'N/A',
                    // 'gender' => $teacherRequest->user->gender ?? 'N/A',
                    'gender' => $gender,



                ],
                'is_favorite' => true,
            ];
        });
        return response()->json($favorites);
    }

    public function store(Request $request, $teacherRequestId)
    {
        $user = auth()->user();
        // $teacherId = $request->input('teacher_id');


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
    public function toggleFavorite(Request $request)
    {
        $user = auth()->user();
        $teacherId = $request->input('teacher_id');


        // $teacherRequest = TeacherRequest::findOrFail($teacherRequestId);

        $favorite = Favorite::where('user_id', $user->id)
                            ->where('teacher_request_id', $teacherId)
                            ->first();

        if ($favorite) {
            // 如果已存在收藏，則刪除
            $favorite->delete();
            return response()->json(['is_favorite' => false]);
        } else {
            // 如果不存在收藏，則添加
            Favorite::create([
                'user_id' => $user->id,
                'teacher_request_id' => $teacherId,
            ]);
            return response()->json(['is_favorite' => true]);
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

    public function showFavorites()
    {
        // 獲取當前用戶的收藏
        $user = Auth::user();
        $favorites = Favorite::where('user_id', $user->id)->get();
        $favorites_array= array();
        $i=0;
        foreach( $favorites as $item){
            $favorites_array[$i] =array();
            $request_id = $item->teacher_request_id;
            $teacher_item = TeacherRequest::where([
                ['user_id'=> $user->id],
                ['id'=> $request_id]
            ])->first();
            $favorite_array =array(
                "title"=>"test"
            );
            $favorites_array[$i] =$favorite_array;
            $i++;
        }



        // 傳遞收藏資料到視圖
        return view('teacherProfile',['favorites'=>$favorites_array ]);
        //return view('teacherProfile', compact('favorites'));
    }

}
?>