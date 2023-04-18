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
Route::group(['middleware'=>'auth:admin'],function (){
    Route::get('/', function () {
        return view('admin.dashboard.home');
    })->name('admin.dashboard');

    Route::group(['prefix'=>'languages'],function (){
        Route::get('/',[\App\Http\Controllers\Dashboard\LanguagesController::class,'index'])->name('admin.languages');
        Route::get('/create',[\App\Http\Controllers\Dashboard\LanguagesController::class,'create'])->name('admin.languages.create');
        Route::post('/store',[\App\Http\Controllers\Dashboard\LanguagesController::class,'store'])->name('admin.languages.store');

    });



});


Route::group([ 'middleware'=>'guest:admin'],function(){
    Route::get('login',[\App\Http\Controllers\Dashboard\LoginController::class,'login'])->name('login');

    Route::post('login',[\App\Http\Controllers\Dashboard\LoginController::class,'checkLogin'])->name('admin.login');
});

