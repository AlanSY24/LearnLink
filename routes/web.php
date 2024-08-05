<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FindTeacherController;
use App\Http\Controllers\StudentPageController;
use App\Http\Controllers\Auth\AuthController;


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
    return redirect('/');
})->name('logout');




Route::view('/findteacher','findteacher');
// Route::match(['get', 'post'], '/findteacher', function () {
//     return view('findteacher');
// });
// Route::post('/findteacher', function () {
//     return view('welcome');
// });
Route::post('/findteacher', [FindTeacherController::class, 'findteacher'])->name('findteacher');


Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');


Route::view('/teacher_lists','teacher_lists');

Route::view('/student_cases','student_cases');

Route::get('/studentpage', [StudentPageController::class, 'index'])->name('studentpage');
Route::post('/studentpage/store', [StudentPageController::class, 'store'])->name('studentpage.store');