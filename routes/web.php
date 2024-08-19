<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FindTeacherController;
use App\Http\Controllers\StudentPageController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\BasicController;
use App\Http\Controllers\Auth\EmailController;
use App\Http\Controllers\Auth\VerifyCodeController;
use App\Http\Controllers\Auth\RegistController;
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
use App\Http\Controllers\ContactStudentController;
use App\Http\Controllers\YourController;
use App\Http\Controllers\RatingController;




use App\Http\Controllers\CalendarController;
use App\Http\Controllers\OtherCalendarController;



use App\Http\Controllers\GetTeacherController;
use App\Http\Controllers\GetStudentController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\DistrictController;

// 首頁↓↓↓↓↓↓↓↓↓↓↓  http://127.0.0.1:8000/homePage
Route::view('/homePage','homePage')->name('homePage');

// 登入頁面↓↓↓↓↓↓↓↓↓↓    http://127.0.0.1:8000/login
Route::view('/login','Auth_login')->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login');
// 登入功能↑↑↑↑↑↑↑↑↑

// 登入測試   http://127.0.0.1:8000/auth_status
Route::view('/auth_status', 'auth_status')->name('auth.status');
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/homePage');
})->name('logout');


// 會員中心基本資料
Route::view('/basic','basicinfo_alpha')->name('basic.page');
Route::post('/infoEdit', [BasicController::class,'infoEdit'])->name('basicinfoForm');



// 寄送email，回復寄送是否成功
Route::post('/seadEmail', [EmailController::class,'sendEmail'])->name('seadEmail');

Route::post('/verify-code', [VerifyCodeController::class, 'verify'])->name('verifyCode');


Route::view('/st','Auth_reset')->name('resetPassword'); // 重設密碼頁面
Route::view('/regist','Auth_resist')->name('registPage');   //註冊頁面
Route::post('/register', [EmailController::class, 'sendEmail'])->name('register');//用於註冊的sendEmail
Route::post('/verify', [RegistController::class,'verify'])->name('registVerify');

Route::get('/', function () {
    return view('welcome');
});
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
    Route::view('/findteacher','findteacher')->name('findteacherPage');
    Route::post('/findteacher', [TeacherController::class, 'storeRequest'])->name('findteacher');
});
Route::middleware('auth')->group(function () {
Route::post('/beteacher', [BeTeacherController::class, 'store'])->name('beteacher.store');
Route::get('/beteacher', [BeTeacherController::class, 'create'])->name('beteacher.create');
});
Route::delete('/delete-event/{id}', [CalendarController::class, 'deleteEvent']);
Route::post('/submit-events', [CalendarController::class, 'submitEvents']);
// Route::get('/calendar', [CalendarController::class, 'index']);
Route::get('/calendar', [CalendarController::class, 'index']);
Route::get('/calendarShow', [CalendarController::class, 'show'])->name('calendar.show');
Route::post('/store-event', [CalendarController::class, 'storeEvent']);
Route::get('/show-events', [CalendarController::class, 'showEvents'])->name('show.events');
Route::get('/show-teacherEvents', [OtherCalendarController::class, 'showEvents'])->name('show.events.teacher');


Route::post('/studentSubmit-events', [OtherCalendarController::class, 'submitEvents']);
// Route::get('/otherCalendar', [OtherCalendarController::class, 'index']);
Route::get('/otherCalendarShow', [OtherCalendarController::class, 'show'])->name('otherCalendar.show');


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
    Route::post('/contact-student', [ContactStudentController::class, 'contactStudent'])->name('contact_student.contactStudent');
    Route::get('/contact/check', [ContactTeacherController::class, 'checkContactStatus'])->name('contact_teacher.check');
    Route::get('/teacher-requests/contact', [ContactStudentController::class, 'showUserTeacherRequestsWithContacts'])->name('user.teacher_requests');
    Route::get('/be_teacher/contact', [ContactTeacherController::class, 'showUserBeTeacherWithContacts'])->name('user.be_teacher');
    Route::post('/contact-student/remove', [ContactStudentController::class, 'remove'])->name('contact_student.remove');
    Route::post('/contact-teacher/remove', [ContactTeacherController::class, 'remove'])->name('contact_teacher.remove');
    Route::post('/keep-selected-student', [ContactStudentController::class, 'keepSelected'])->name('student.keepSelected');
    Route::post('/keep-selected-teacher', [ContactTeacherController::class, 'keepSelected'])->name('teacher.keepSelected');
    Route::post('/teacher-requests/update-status', [ContactStudentController::class, 'updateStatus'])->name('teacher_requests.updateStatus');
    Route::post('/be_teacher/update-status', [ContactTeacherController::class, 'updateStatus'])->name('be_teacher.updateStatus');
    Route::post('/rate-teacher', [RatingController::class, 'rateTeacher'])->name('rate-teacher');
    Route::get('/teacher/rating', [RatingController::class, 'showTeacherRating'])->name('showTeacherRating');
});



Route::get('/teacher_lists', [GetTeacherController::class, 'index'])->name('teacher_list');
Route::get('/student_cases', [GetStudentController::class, 'index'])->name('student_case');

Route::get('/cities', [CityController::class, 'index']);
Route::get('/districts/{cityId}', [DistrictController::class, 'getDistricts']);


use App\Http\Controllers\TeacherListsFavoriteController;

// Routes for managing favorites
Route::post('/teacher_lists/favorites/{teacherId}', [TeacherListsFavoriteController::class, 'store']);
Route::delete('/teacher_lists/favorites/{teacherId}', [TeacherListsFavoriteController::class, 'destroy']);Route::get('/teacher_profiles/{teacherId}', [GetTeacherController::class, 'show'])->name('teacher_profiles.show');
Route::get('/teacher_lists/favorites/status/{teacherId}', [TeacherListsFavoriteController::class, 'status']);


Route::get('/teacher_profiles/{teacherId}', [GetTeacherController::class, 'show'])->name('teacher_profiles.show');



use App\Http\Controllers\StudentCasesFavoriteController;

Route::prefix('student_cases')->group(function () {
    // 获取收藏状态
    Route::get('favorites/status/{teacherRequestId}', [StudentCasesFavoriteController::class, 'status'])
         ->name('favorites.status');

    // 添加收藏
    Route::post('favorites/{teacherRequestId}', [StudentCasesFavoriteController::class, 'store'])
         ->name('favorites.store');

    // 移除收藏
    Route::delete('favorites/{teacherRequestId}', [StudentCasesFavoriteController::class, 'destroy'])
         ->name('favorites.destroy');
});

// 顯示教師頭像
Route::get('/teacher/{teacherId}/photo', [GetTeacherController::class, 'showPhoto'])->name('teacher.photo');


Route::post('/contact_teacher', [ContactTeacherController::class, 'store'])->name('contact.teacher');

Route::post('/contact_student', [ContactStudentController::class, 'store'])->name('contact.student');
Route::get('teacher/rating/{teacherId}', [GetTeacherController::class, 'showTeacherRating'])->name('teacher.rating');

// 抓大頭照
Route::get('/get-teacher-photo/{studentId}', [YourController::class, 'getTeacherPhoto'])->name('get.teacher.photo');