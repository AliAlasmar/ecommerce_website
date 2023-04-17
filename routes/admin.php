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
    return view('admin.dashboard.home');
})->name('admin.dashboard')->middleware('auth:admin');

Route::group([ 'middleware'=>'guest:admin'],function(){
    Route::get('login',[\App\Http\Controllers\Dashboard\LoginController::class,'login'])->name('login');

    Route::post('login',[\App\Http\Controllers\Dashboard\LoginController::class,'checkLogin'])->name('admin.login');
});

