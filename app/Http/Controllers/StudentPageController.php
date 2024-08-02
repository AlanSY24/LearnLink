<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentPage;
use Illuminate\Support\Facades\Auth;

class StudentPageController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $children_card = $user->StudentPage; // 獲取用戶的所有文章
        return view('studentpage', compact('user', 'children_card'));



    }

    public function store(Request $request) {
        try {
            $request->validate([
                'user_id' => 'required|exists:users,id',
                'children_name' => 'required|string|max:255',
                'children_birthdate' => 'required|date',
                'children_gender' => 'required|in:Male,Female',
            ]);
    
            $children_card = new StudentPage();
            $children_card->user_id = $request->user_id;
            $children_card->children_name = $request->children_name;
            $children_card->children_birthdate = $request->children_birthdate;
            $children_card->children_gender = $request->children_gender;
            $children_card->save();
    
            return redirect()->route('studentpage')->with('success', '學生資料已成功儲存！');
        } catch (\Exception $e) {
            // 顯示異常信息
            dd($e->getMessage());
        }
    }
}