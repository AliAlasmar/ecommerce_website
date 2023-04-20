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

    ######### Bgain languages ###############
    Route::group(['prefix'=>'languages'],function (){
        Route::get('/',[\App\Http\Controllers\Dashboard\LanguagesController::class,'index'])->name('admin.languages');
        Route::get('/create',[\App\Http\Controllers\Dashboard\LanguagesController::class,'create'])->name('admin.languages.create');
        Route::post('/store',[\App\Http\Controllers\Dashboard\LanguagesController::class,'store'])->name('admin.languages.store');
        Route::get('/edit/{id}',[\App\Http\Controllers\Dashboard\LanguagesController::class,'edit'])->name('admin.languages.edit');
        Route::post('/update/{id}',[\App\Http\Controllers\Dashboard\LanguagesController::class,'update'])->name('admin.languages.update');

    });
    ######### End languages ###############

    ######### Bgain maincategories ###############
    Route::group(['prefix'=>'maincategories'],function (){
        Route::get('/',[\App\Http\Controllers\Dashboard\MainCategoryController::class,'index'])->name('admin.maincategories');
        Route::get('/create',[\App\Http\Controllers\Dashboard\MainCategoryController::class,'create'])->name('admin.maincategories.create');
        Route::post('/store',[\App\Http\Controllers\Dashboard\MainCategoryController::class,'store'])->name('admin.maincategories.store');
        Route::get('/edit/{id}',[\App\Http\Controllers\Dashboard\MainCategoryController::class,'edit'])->name('admin.maincategories.edit');
        Route::post('/update/{id}',[\App\Http\Controllers\Dashboard\MainCategoryController::class,'update'])->name('admin.maincategories.update');

    });
    ######### End maincategories ###############

});


Route::group([ 'middleware'=>'guest:admin'],function(){
    Route::get('login',[\App\Http\Controllers\Dashboard\LoginController::class,'login'])->name('login');

    Route::post('login',[\App\Http\Controllers\Dashboard\LoginController::class,'checkLogin'])->name('admin.login');
});

Route::get('test-helper',function (){
   return get_defualt_language();
});
