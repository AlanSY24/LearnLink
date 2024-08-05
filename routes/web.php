<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FindTeacherController;
use App\Http\Controllers\StudentPageController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\ChildrenCardController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\StudentProfileController;
use App\Http\Controllers\TeacherProfileController;
use App\Http\Controllers\BeTeacherController;


Route::get('/', function () {
    return view('welcome');
});

// http://localhost/LearnLink/public/

// 首頁↓↓↓↓↓↓↓↓↓↓↓  http://127.0.0.1:8000/homePage
Route::view('/homePage','homepage');

// 登入頁面↓↓↓↓↓↓↓↓↓↓    http://127.0.0.1:8000/login
Route::view('/login','login')->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login');
// 登入功能↑↑↑↑↑↑↑↑↑

// 註冊↓↓↓↓↓↓↓↓↓↓    
Route::post('/register', [AuthController::class, 'register']);

// 登入測試   http://127.0.0.1:8000/auth_status
Route::view('/auth_status', 'auth_status')->name('auth.status');
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');
//盧彥辰的路由
//發案找老師的路由
// Route::view('/findteacher','findteacher');
// 抓城市地區路由
Route::get('/cities', [LocationController::class, 'getCities']);
Route::get('/districts/{cityId}', [LocationController::class, 'getDistricts']);
//傳入資料庫
// Route::post('/findteacher', [TeacherController::class, 'storeRequest'])->name('findteacher');
//抓科目
Route::get('/subjects', [SubjectController::class, 'index']);


Route::middleware('auth')->group(function () {
    Route::view('/findteacher','findteacher');
    Route::post('/findteacher', [TeacherController::class, 'storeRequest'])->name('findteacher');
});
Route::post('/beteacher', [BeTeacherController::class, 'store'])->name('beteacher.store');
Route::get('/beteacher', [BeTeacherController::class, 'create'])->name('beteacher.create');

//-------------------------------------

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');


Route::view('/teacher_lists','teacher_lists');

Route::view('/student_cases','student_cases');

// Route::get('/studentpage', [StudentPageController::class, 'index'])->name('studentpage');
// Route::post('/studentpage/store', [StudentPageController::class, 'store'])->name('studentpage.store');
Route::middleware('auth')->group(function () {
    Route::get('/studentpage', [StudentPageController::class, 'index'])->name('studentpage');
    Route::post('/studentpage/store', [StudentPageController::class, 'store'])->name('studentpage.store');
    Route::delete('/studentpage/{id}', [StudentPageController::class, 'destroy'])->name('studentpage.destroy');
    Route::get('/studentprofile', [StudentProfileController::class, 'index'])->name('studentprofile');
    Route::post('/studentprofile/store', [StudentProfileController::class, 'store'])->name('studentprofile.store');
    Route::get('/teacherprofile', [TeacherProfileController::class, 'index'])->name('teacherprofile.index');
    Route::post('/teacherprofile/store', [TeacherProfileController::class, 'store'])->name('teacherprofile.store');
});
Route::get('/test-image', function() {
    $path = storage_path('app/public/photos/eCVJvkxPuuIWqid62wV93O2kiriq3mcXUNxZZP1r.jpg');
    return response()->file($path);
});