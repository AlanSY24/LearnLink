<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FindTeacherController;
use App\Http\Controllers\StudentPageController;
use App\Http\Controllers\Auth\AuthController;
<<<<<<< HEAD
use App\Http\Controllers\CityController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
=======
use App\Http\Controllers\LocationController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\ChildrenCardController;

>>>>>>> 51e465dcfcc85e3217274027b7ae07c0abf18374

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

//發案找老師的路由
Route::view('/findteacher','findteacher');
// 抓城市地區路由
Route::get('/cities', [LocationController::class, 'getCities']);
Route::get('/districts/{cityId}', [LocationController::class, 'getDistricts']);
//傳入資料庫
Route::post('/findteacher', [TeacherController::class, 'storeRequest'])->name('findteacher');




Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');



<<<<<<< HEAD
Route::get('/studentpage', [StudentPageController::class, 'index'])->name('studentpage');
Route::post('/studentpage/store', [StudentPageController::class, 'store'])->name('studentpage.store');


// 獲取城市列表
Route::get('/cities', [CityController::class, 'index']);
// 獲取區域列表
Route::get('/districts/{cityId}', [DistrictController::class, 'getDistricts']);

Route::get('/teacher_lists', [SubjectController::class, 'index'])->name('teacher_lists');
Route::get('/student_cases', [SubjectController::class, 'index'])->name('student_cases');



// 老師列表搜尋
Route::get('/search', [TeacherController::class, 'search']);
=======
// Route::get('/studentpage', [StudentPageController::class, 'index'])->name('studentpage');
// Route::post('/studentpage/store', [StudentPageController::class, 'store'])->name('studentpage.store');
Route::middleware('auth')->group(function () {
    Route::get('/studentpage', [StudentPageController::class, 'index'])->name('studentpage');
    Route::post('/studentpage/store', [StudentPageController::class, 'store'])->name('studentpage.store');
});
>>>>>>> 51e465dcfcc85e3217274027b7ae07c0abf18374
