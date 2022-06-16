<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('/user', function () {
    return view('user');
});

Route::get('/leaderboard', function () {
    return view('leaderboard');
});

Route::resource('/user', \App\Http\Controllers\HomeController::class);
Route::resource('/leaderboard', \App\Http\Controllers\TestController::class);


Auth::routes();

Route::get('/user', [App\Http\Controllers\HomeController::class, 'index'])->name('user');
Route::post('/save', [\App\Http\Controllers\TestController::class, 'update']);
Route::post('/delete', [\App\Http\Controllers\HomeController::class, 'delete_best_record']);

