<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FindTeacherController;

Route::get('/', function () {
    return view('welcome');
});
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