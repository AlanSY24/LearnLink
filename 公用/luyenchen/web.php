<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FindTeacherController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\TeacherController;

Route::get('/', function () {
    return view('welcome');
});
Route::view('/findteacher','findteacher');
Route::view('/beteacher','beteacher');
Route::get('/customer', function () {
    return view('customer');
});

// Route::view('./customer','customer');
// Route::match(['get', 'post'], '/findteacher', function () {
//     return view('findteacher');
// });

// Route::post('/findteacher', [FindTeacherController::class, 'findteacher'])->name('findteacher');


Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');
Route::get('/cities', [LocationController::class, 'getCities']);
Route::get('/districts/{cityId}', [LocationController::class, 'getDistricts']);

Route::post('/findteacher', [TeacherController::class, 'storeRequest'])->name('findteacher');