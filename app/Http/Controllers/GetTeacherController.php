<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\GetTeacher;
use App\Models\Subject;
use Illuminate\Http\Request;

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

        // 篩選區域
        if ($request->has('district') && $request->district != '') {
            $query->whereJsonContains('district_ids', $request->district);
        }

        // 篩選預算
        if ($request->has('minBudget') && $request->has('maxBudget')) {
            $query->whereBetween('hourly_rate', [$request->minBudget, $request->maxBudget]);
        }

        // 筛选可用时间
        if ($request->has('time')) {
            $times = explode(',', $request->time);
            $conditions = [];
            foreach ($times as $time) {
                // 确保时间值被正确包裹在引号中
                $conditions[] = 'FIND_IN_SET(\''. $time .'\', available_time) > 0';
            }
            $query->whereRaw(implode(' OR ', $conditions));
        }

        // 取得篩選後的教師資料
        $teachers = $query->with('subject', 'city', 'user')->get();

        // 使用 compact 將變量名改為 'teachers', 'subjects', 'cities'
        return view('teacher_lists', compact('teachers', 'subjects', 'cities'));
    }
}
