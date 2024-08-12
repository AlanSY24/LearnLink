<?php

namespace App\Http\Controllers;
use App\Models\City;
use App\Models\GetStudent;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        

        // 筛选预算
        if ($request->has('minBudget') && $request->has('maxBudget')) {
            $query->whereBetween('hourly_rate', [$request->minBudget, $request->maxBudget]);
        }

        // 筛选可用时间
        if ($request->has('time')) {
            $times = explode(',', $request->time);
            $conditions = [];
            foreach ($times as $time) {
                $conditions[] = 'FIND_IN_SET(\''. $time .'\', available_time) > 0';
            }
            $query->whereRaw(implode(' OR ', $conditions));
        }

        // 获取所有学生数据
        $students = $query->with('subject', 'city', 'user')->get();

        return view('student_cases', compact('students', 'subjects', 'cities'));
    }
}
