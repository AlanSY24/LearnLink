<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FavoriteStudent;
use App\Models\BeTeacher;

class FavoriteStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $beTeachers = BeTeacher::with(['subject', 'city'])->get();
        return view('student_requests', compact('beTeachers'));
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
