<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\GetStudent;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class GetStudentController extends Controller
{
    /**
     * 顯示所有學生案件
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // 取得所有科目
        $subjects = Subject::select('id', 'name')->get();

        // 取得所有城市
        $cities = City::select('id', 'city')->get();

        // 初始化查询
        $query = GetStudent::query();

        // 筛选科目
        if ($request->has('subject') && $request->subject != '0') {
            $query->where('subject_id', $request->subject);
        }

        // 筛选城市
        if ($request->has('city') && $request->city != '') {
            $query->where('city_id', $request->city);
        }

        // 筛选区
        if ($request->has('district') && $request->district != '') {
            $query->whereJsonContains('district_ids', $request->district);
        }

        // 筛选预算
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

        // 获取所有学生数据
        $students = $query->with('subject', 'city', 'user')->get();

        return view('student_cases', compact('students', 'subjects', 'cities'));
    }


}
