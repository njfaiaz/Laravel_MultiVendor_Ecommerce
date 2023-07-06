<?php

use App\Http\Controllers\User\UserController;
Use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\VendorManageController;
use App\Http\Controllers\Vendor\VendorController;
use App\Models\Brand;
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
    return view('frontend.index');
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

    // ------------------------------ Admin Brand Page----------------------------------
    Route::get('brand', [BrandController::class, 'index'])->name('brand');
    Route::get('brand/add', [BrandController::class, 'add'])->name('brand.add');
    Route::post('brand/store', [BrandController::class, 'Store'])->name('brand.store');
    Route::get('brand/edit/{id}', [BrandController::class, 'Edit'])->name('brand.edit');
    Route::post('brand/update/{id}', [BrandController::class, 'Update'])->name('brand.update');
    Route::get('brand/delete/{id}', [BrandController::class, 'Delete'])->name('brand.delete');

    // ------------------------------ Admin Category Page----------------------------------
    Route::get('category', [CategoryController::class, 'index'])->name('category');
    Route::get('category/add', [CategoryController::class, 'add'])->name('category.add');
    Route::post('category/store', [CategoryController::class, 'Store'])->name('category.store');
    Route::get('category/edit/{id}', [CategoryController::class, 'Edit'])->name('category.edit');
    Route::post('category/update/{id}', [CategoryController::class, 'Update'])->name('category.update');
    Route::get('category/delete/{id}', [CategoryController::class, 'Delete'])->name('category.delete');

    // ------------------------------ Admin Sub-Category Page----------------------------------
    Route::get('subcategory', [SubCategoryController::class, 'index'])->name('subcategory');
    Route::get('subcategory/add', [SubCategoryController::class, 'add'])->name('subcategory.add');
    Route::post('subcategory/store', [SubCategoryController::class, 'Store'])->name('subcategory.store');
    Route::get('subcategory/edit/{id}', [SubCategoryController::class, 'Edit'])->name('subcategory.edit');
    Route::post('subcategory/update/{id}', [SubCategoryController::class, 'Update'])->name('subcategory.update');
    Route::get('subcategory/delete/{id}', [SubCategoryController::class, 'Delete'])->name('subcategory.delete');
    Route::get('/subcategory/ajax/{category_id}', [SubCategoryController::class, 'GetSubCategory']);






    // ------------------------------ Admin Vendor Manage Page----------------------------------
    Route::get('vendorInactive', [VendorManageController::class, 'vendorInactive'])->name('inactive.vendor');
    Route::get('vendorActive', [VendorManageController::class, 'vendorActive'])->name('active.vendor');
    Route::get('inactive/vendor/details/{id}', [VendorManageController::class, 'inActiveDetails'])->name('inactive.vendor.details');
    Route::post('inactive/vendor/active', [VendorManageController::class, 'activeVendorApprove'])->name('active.vendor.approve');
    Route::get('active/vendor/details/{id}', [VendorManageController::class, 'ActiveDetails'])->name('active.vendor.details');
    Route::post('active/vendor/inactive', [VendorManageController::class, 'inActiveVendorApprove'])->name('inactive.vendor.approve');

    // ------------------------------ Admin Product Manage Page----------------------------------
    Route::get('product', [ProductController::class, 'index'])->name('product');
    Route::get('product/add', [ProductController::class, 'add'])->name('product.add');
    Route::post('product/store', [ProductController::class, 'Store'])->name('product.store');
    Route::get('product/edit/{id}', [ProductController::class, 'Edit'])->name('product.edit');
    Route::post('product/update/{id}', [ProductController::class, 'Update'])->name('product.update');
    Route::get('product/delete/{id}', [ProductController::class, 'Delete'])->name('product.delete');





});// Admin Group Middleware End




// ===================================== Vendor Dashboard All Part =====================================

Route::group(['prefix'=>'vendor','middleware' =>['vendor','auth'],'namespace'=>'Vendor'], function(){

    // ------------------------------ Vendor Home Page----------------------------------
    Route::get('dashboard',[VendorController::class,'index'])->name('vendor.dashboard');
    Route::get('profile',[VendorController::class,'profile'])->name('vendor.profile');
    Route::post('profile/store', [VendorController::class, 'Store'])->name('vendor.profile.store');
    Route::get('password/change', [VendorController::class, 'ChangePassword'])->name('vendor.ChangePassword');
    Route::post('password/change', [VendorController::class, 'ChangeStore'])->name('vendor.password.store');
});// Vendor Group Middleware End









// ===================================== User Dashboard All Part =====================================

Route::group(['middleware' =>['user','auth'],'namespace'=>'User'], function(){

        // ------------------------------ User Profile Page----------------------------------
    Route::get('dashboard',[UserController::class,'Dashboard'])->name('user.dashboard');
    Route::post('user/profile/store', [UserController::class, 'Store'])->name('user.profile.store');
    Route::post('password/change', [UserController::class, 'ChangeStore'])->name('user.password.store');





});  // User Group Middleware End




// ================================= General User All Route This ===========================================

            //    ------------------ User Login Or Register  --------------------------------------
    Route::get('user/login',[UserController::class,'userLogin'])->name('user.login');
    Route::get('user/register',[UserController::class,'userRegister'])->name('user.register');


            //    ------------------ Vendor Login Or Register  --------------------------------------
    Route::get('become/vendor',[VendorController::class,'BecomeVendor'])->name('become.vendor');
    Route::get('vendor/login',[VendorController::class,'BecomeVendorLogin'])->name('become.vendor.login');
    Route::post('vendor/register',[VendorController::class,'vendorCreate'])->name('vendor.register');


