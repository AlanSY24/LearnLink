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
use App\Http\Controllers\FavoriteController;



use App\Http\Controllers\CalendarController;


use App\Http\Controllers\GetTeacherController;
use App\Http\Controllers\GetStudentController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\DistrictController;


Route::get('/', function () {
    return view('welcome');
});


// 首頁↓↓↓↓↓↓↓↓↓↓↓  http://127.0.0.1:8000/homePage
Route::view('/homePage','homepage')->name('homePage');

// 登入頁面↓↓↓↓↓↓↓↓↓↓    http://127.0.0.1:8000/login
Route::view('/login','login')->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login');
// 登入功能↑↑↑↑↑↑↑↑↑

// 註冊↓↓↓↓↓↓↓↓↓↓    
Route::post('/pre-register', [AuthController::class, 'preRegister']);
Route::post('/register', [AuthController::class, 'register']);

// 寄   email   ↓↓↓↓↓↓↓↓↓↓↓↓
Route::post('/send-email', [AuthController::class,'sendEmail']);

// 登入測試   http://127.0.0.1:8000/auth_status
Route::view('/auth_status', 'auth_status')->name('auth.status');
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/homePage');
})->name('logout');

Route::post('/forgot-password', [AuthController::class,'forgot']);
Route::post('/forgot_2', [AuthController::class, 'forgot_2'])->name('forgot_2');
Route::post('/forget_3', [AuthController::class, 'forgot_3'])->name('forgot_3');
Route::view('/reset', 'reset_code')->name('reset');


// 會員中心基本資料
Route::view('/basic','basicinfo_alpha')->name('basic.page');
Route::view('/bbasic','basicinfo_beta')->name('bbasic.page');



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
Route::delete('/delete-event/{id}', [CalendarController::class, 'deleteEvent']);
Route::post('/submit-events', [CalendarController::class, 'submitEvents']);
Route::get('/calendar', [CalendarController::class, 'index']);
Route::post('/store-event', [CalendarController::class, 'storeEvent']);

//-------------------------------------

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');






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
    Route::get('/teacher-requests', [FavoriteController::class, 'index'])->name('teacher-requests');
    // 收藏教師請求
    Route::post('/teacher-requests/{teacherRequest}/favorite', [FavoriteController::class, 'store'])->name('favorites.store');

    // 取消收藏教師請求
    Route::delete('/teacher-requests/{teacherRequest}/favorite', [FavoriteController::class, 'destroy'])->name('favorites.destroy');
});



Route::get('/teacher_lists', [GetTeacherController::class, 'index']);
Route::get('/student_cases', [GetStudentController::class, 'index']);

Route::get('/cities', [CityController::class, 'index']);
Route::get('/districts/{cityId}', [DistrictController::class, 'getDistricts']);