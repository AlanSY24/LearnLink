<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FindTeacherController;
use App\Http\Controllers\StudentPageController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\BasicController;
use App\Http\Controllers\Auth\EmailController;
use App\Http\Controllers\Auth\forgot;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\ChildrenCardController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\StudentProfileController;
use App\Http\Controllers\TeacherProfileController;
use App\Http\Controllers\BeTeacherController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\FavoriteStudentController;
use App\Http\Controllers\ContactTeacherController;



use App\Http\Controllers\CalendarController;
use App\Http\Controllers\OtherCalendarController;



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

Route::post('/forgot-password', [forgot::class,'forgot']);
Route::post('/forgot-password-reset', [forgot::class, 'forgot_2'])->name('forgot_2');


// 會員中心基本資料
Route::view('/basic','basicinfo_alpha')->name('basic.page');
Route::post('/infoEdit', [BasicController::class,'infoEdit'])->name('basicinfoForm');

// 寄送email
Route::view('/st','send-email')->name('st');
Route::post('/seadEmail', [EmailController::class,'sendEmail'])->name('seadEmail');







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
Route::get('/show-events', [CalendarController::class, 'showEvents'])->name('show.events');


Route::post('/studentSubmit-events', [OtherCalendarController::class, 'submitEvents']);
Route::get('/otherCalendar', [OtherCalendarController::class, 'index']);


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
    // Route::delete('/teacher-requests/{teacherRequest}/favorite', [FavoriteController::class, 'destroy'])->name('favorites.destroy');
    Route::get('/be-teachers', [FavoriteStudentController::class, 'index'])->name('be-teachers.index');
    Route::post('/be-teachers/{beTeacher}/favorite', [FavoriteStudentController::class, 'store'])->name('favorites_student.store');
    // Route::delete('/be-teachers/{beTeacher}/favorite', [FavoriteStudentController::class, 'destroy'])->name('favorites_student.destroy');
    // 獲取收藏列表
    Route::get('/favorites-student', [FavoriteStudentController::class, 'studentFavorite'])->name('favorites_student.studentFavorite');
    Route::get('/favorites-teacher', [FavoriteController::class, 'teacherFavorite'])->name('favorites_teacher.teacherFavorite');
    Route::post('/toggle-favorite', [FavoriteStudentController::class, 'toggleFavorite'])->name('favorites_student.toggleFavorite');
    Route::post('/toggle-favorite-teacher', [FavoriteController::class, 'toggleFavorite'])->name('favorites_teacher.toggleFavorite');


    // 其他按鈕功能待定

    Route::post('/contact-teacher', [ContactTeacherController::class, 'contactTeacher'])->name('contact_teacher.contactTeacher');
    Route::get('/contact/check', [ContactTeacherController::class, 'checkContactStatus'])->name('contact_teacher.check');

});



Route::get('/teacher_lists', [GetTeacherController::class, 'index']);
Route::get('/student_cases', [GetStudentController::class, 'index']);

Route::get('/cities', [CityController::class, 'index']);
Route::get('/districts/{cityId}', [DistrictController::class, 'getDistricts']);

// 抓大頭照
Route::get('/get-teacher-photo/{studentId}', [YourController::class, 'getTeacherPhoto'])->name('get.teacher.photo');