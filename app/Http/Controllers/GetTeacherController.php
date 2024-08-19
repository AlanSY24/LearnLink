<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\GetTeacher;
use App\Models\Subject;
use Illuminate\Http\Request;
use App\Models\TeacherProfile;


class GetTeacherController extends Controller
{
    /**
     * 顯示所有教師資料
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // 取得所有科目
        $subjects = Subject::select('id', 'name')->get();

        // 取得所有城市
        $cities = City::select('id', 'city')->get();

        // 初始化查詢
        $query = GetTeacher::query();

        // 篩選科目
        if ($request->has('subject') && $request->subject != '0') {
            $query->where('subject_id', $request->subject);
        }

        // 篩選城市
        if ($request->has('city') && $request->city != '') {
            $query->where('city_id', $request->city);
        }

        // 筛选区
        if ($request->has('districts') && $request->districts != '') {
            $districts = explode(',', $request->districts); // 处理多个区

            // 创建 JSON_CONTAINS 条件
            $districtConditions = [];
            foreach ($districts as $district) {
                $district = (int) $district; // 确保区 ID 是整数
                $districtConditions[] = "JSON_CONTAINS(district_ids, '\"$district\"', '$')";
            }

            // 使用 orWhereRaw 连接多个条件
            if (!empty($districtConditions)) {
                $query->whereRaw(implode(' OR ', $districtConditions));
            }
        }

        // 篩選預算
        if ($request->has('minBudget') && $request->has('maxBudget')) {
            $minBudget = (int) $request->minBudget;
            $maxBudget = (int) $request->maxBudget;

            // 確保預算區間合理
            if ($minBudget < $maxBudget) {
                $query->whereBetween('hourly_rate', [$minBudget, $maxBudget]);
            }
        } else if ($request->has('maxBudget')) {
            $maxBudget = (int) $request->maxBudget;
            $query->where('hourly_rate', '<=', $maxBudget);
        }

        // 处理并添加时间
        if ($request->has('time')) {
            $times = explode(',', $request->time);
            $conditions = [];
            foreach ($times as $time) {
                $time = trim($time); // 去除前后的空格
                $conditions[] = 'FIND_IN_SET(\'' . addslashes($time) . '\', available_time) > 0';
            }
            if (!empty($conditions)) {
                $query->whereRaw(implode(' OR ', $conditions));
            }
        }

        // 取得篩選後的教師資料
        $teachers = $query->with('subject', 'city', 'user')->get();

        // 如果沒有找到教師資料，返回404和訊息
        if ($teachers->isEmpty()) {
            return response()->json(['message' => '沒有相關資訊，請重新查詢謝謝'], 404);
        }

        // 使用 compact 將變量名改為 'teachers', 'subjects', 'cities'
        return view('teacher_lists', compact('teachers', 'subjects', 'cities'));
    }

    public function show($teacherId)
    {
        $teacherProfile = TeacherProfile::where('user_id', $teacherId)->firstOrFail();
        
        if ($teacherProfile->pdf) {
            return response()->make($teacherProfile->pdf, 200, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="resume.pdf"'
            ]);
        }

        return redirect()->back()->with('error', '無法找到老師的履歷');
    }
}
