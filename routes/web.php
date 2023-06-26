<?php

use App\Http\Controllers\User\UserController;
Use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Auth;
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
    return view('welcome');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// ===================================== Admin Dashboard All Part =====================================

Route::group(['prefix'=>'admin','middleware' =>['admin','auth'],'namespace'=>'Admin'], function(){

    // ------------------------------ Admin Home Page----------------------------------
    Route::get('dashboard',[AdminController::class,'index'])->name('admin.dashboard');
    Route::get('profile',[AdminController::class,'profile'])->name('admin.profile');
    Route::post('profile/store', [AdminController::class, 'Store'])->name('admin.profile.store');
    Route::get('password/change', [AdminController::class, 'ChangePassword'])->name('admin.ChangePassword');
    Route::post('password/change', [AdminController::class, 'ChangeStore'])->name('admin.password.store');
});


// Route::get('service', [ServiceController::class, 'index'])->name('service');
// Route::get('service/add', [ServiceController::class, 'add'])->name('service.add');
// Route::post('service/store', [ServiceController::class, 'Store'])->name('service.store');
// Route::get('service/edit/{id}', [ServiceController::class, 'Edit'])->name('service.edit');
// Route::post('service/update/{id}', [ServiceController::class, 'Update'])->name('service.update');
// Route::get('service/delete/{id}', [ServiceController::class, 'Delete'])->name('service.delete');



Route::group(['prefix'=>'user','middleware' =>['user','auth'],'namespace'=>'User'], function(){
    Route::get('dashboard',[UserController::class,'index'])->name('user.dashboard');
});



