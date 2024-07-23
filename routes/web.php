<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FindTeacherController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Auth\AuthController;


Route::get('/', function () {
    return view('welcome');
});

// http://localhost/LearnLink/public/

// 首頁↓↓↓↓↓↓↓↓↓↓↓  http://127.0.0.1:8000/homePage
Route::view('/homePage','homepage');

// 登入頁面↓↓↓↓↓↓↓↓↓↓    http://127.0.0.1:8000/login
Route::view('/login','login')->name('login');

// 註冊↓↓↓↓↓↓↓↓↓↓    
Route::post('/register', [AuthController::class, 'register']);

// 登入↓↓↓↓↓↓ 
Route::post('/login', [App\Http\Controllers\Auth\AuthController::class, 'login'])->name('login');


Route::post('/check-user', [LoginController::class, 'checkUser'])->name('check.user');


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

Route::view('/studentpage','studentpage');

Route::view('/teacher_lists','teacher_lists');

Route::view('/student_cases','student_cases');
