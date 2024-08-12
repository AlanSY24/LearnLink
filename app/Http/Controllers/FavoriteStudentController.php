<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FavoriteStudent;
use App\Models\BeTeacher;
use App\Models\District;
use App\Models\City;


class FavoriteStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $beTeachers = BeTeacher::with(['subject', 'city'])->get();
        // dd($beTeachers);

        return view('student_requests', compact('beTeachers'));
    }

    public function studentFavorite()
    {
        $user = auth()->user();

        $favorites = FavoriteStudent::where('user_id', $user->id)
        ->with('beTeacher.subject', 'beTeacher.city',
        )
        ->get()
        ->map(function ($favorite) {
            $beTeacher = $favorite->beTeacher;
            // 直接使用 available_time 字段的字符串值
            $availableTime = $beTeacher->available_time;
            $districtsIds = $favorite->beTeacher->district_ids;
            $districts = $beTeacher->city->districts
                ->whereIn('id', $districtsIds)
                ->pluck('district_name')
                ->toArray();

            return [
                'be_teacher' => [
                    'title' => $beTeacher->title,
                    'subject' => $beTeacher->subject->name ?? 'N/A',
                    'city' => $beTeacher->city->city ?? 'N/A',
                    'available_time' => $availableTime,  // 保持字符串格式
                    'hourly_rate' => $beTeacher->hourly_rate,
                    'districts' => $districts,
                ],
                'is_favorite' => true,
            ];
        });
        return response()->json($favorites);
    }

    public function store(Request $request, $beTeacherId)
    {
        $user = $request->user();
        $beTeacher = BeTeacher::findOrFail($beTeacherId);

        $favorite = FavoriteStudent::where('user_id', $user->id)
                                   ->where('be_teachers_id', $beTeacherId)
                                   ->first();

        if ($favorite) {
            $favorite->delete();
            $favorited = false;
        } else {
            FavoriteStudent::create([
                'user_id' => $user->id,
                'be_teachers_id' => $beTeacherId,
            ]);
            $favorited = true;
        }

        return response()->json(['favorited' => $favorited]);
    }

    public function destroy(Request $request, $beTeacherId)
    {
        $user = $request->user();

        FavoriteStudent::where('user_id', $user->id)
                       ->where('be_teachers_id', $beTeacherId)
                       ->delete();

        return response()->json(['favorited' => false]);
    }
}
