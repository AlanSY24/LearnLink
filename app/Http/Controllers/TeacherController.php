<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * Search for teachers based on request parameters.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(Request $request)
    {
        // 构建查询
        $query = Teacher::with('user'); // 加载用户关系

        // 根据请求参数筛选数据
        if ($request->has('subject') && $request->subject != 0) {
            $query->where('subject', $request->subject);
        }

        if ($request->has('minBudget') && $request->has('maxBudget')) {
            $query->whereBetween('min_price', [$request->minBudget, $request->maxBudget])
                  ->whereBetween('max_price', [$request->minBudget, $request->maxBudget]);
        }

        if ($request->has('city')) {
            $query->where('city', $request->city);
        }

        if ($request->has('district')) {
            $query->where('district', $request->district);
        }

        if ($request->has('time')) {
            $query->where('time', $request->time);
        }

        // 执行查询并获取结果
        $teachers = $query->get();

        // 返回 JSON 响应
        return response()->json(['teachers' => $teachers]);
    }
}