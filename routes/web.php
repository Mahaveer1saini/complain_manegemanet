<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\front\UserController;
use App\Http\Controllers\backend\adminController;
use App\Http\Controllers\backend\StateController;
use App\Http\Controllers\Backend\UsersController;
use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\backend\ComplaintController;
use App\Http\Controllers\backend\subcategoryController;


Route::get('/', function () {
    return view('welcome');
});
    Route::group(['prefix' => '/user', 'as' => 'user.'], function () {
    Route::get('/login_register', [UserController::class, 'showRegistrationForm'])->name('login_register');
    Route::post('/registerStore', [UserController::class, 'register'])->name('register.store');
    Route::get('/user_login', [UserController::class, 'showLoginForm'])->name('login');
    Route::post('/user_login', [UserController::class, 'login'])->name('login.store');
    Route::get('/user_dashboard', [UserController::class, 'user_dashboard'])->name('user_dashboard')->middleware('auth');
    Route::get('/logout', [ UserController::class, 'logout'])->name('logout');
    Route::get('/profile/{id}', [ UserController::class, 'User_profile'])->name('profile');
    Route::post('/profile/update{id}',[ UserController::class, 'User_update'])->name('profile.update');
    Route::get('change-password', [UserController::class, 'change_password'])->name('change_password');
    Route::post('/update-password', [UserController::class, 'updatePassword'])->name('updatePassword');
    //complain model
    Route::get('/complaint', [ComplaintController::class, 'complaint'])->name('complaint');
    Route::post('/submit-complaint', [ComplaintController::class, 'submitComplaint'])->name('complaint.submit');
    Route::post('/getsubcat', [ComplaintController::class, 'getSubcategories'])->name('getsubcat');
    Route::get('/complaint-history', [ComplaintController::class, 'complaint_history'])->name('complaint-history');
    Route::get('/complaint-details/{id}', [ComplaintController::class, 'complaint_show'])->name('complaint.details');
    Route::get('/complaint_update/{id}', [ComplaintController::class, 'complaint_update'])->name('complaint_update');
    Route::post('/complaint_edit/{id}', [ComplaintController::class, 'complaint_edit'])->name('complaint_edit');
    Route::get('/complaint_destroy/{id}', [ComplaintController::class, 'complaint_destroy'])->name('complaint_destroy');
    
    //categories
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    //states
    Route::get('/states', [StateController::class, 'index'])->name('states.index');
    Route::get('/states/create', [StateController::class, 'create'])->name('states.create');
    Route::post('/states', [StateController::class, 'store'])->name('states.store');
    Route::get('/states/{state}/edit', [StateController::class, 'edit'])->name('states.edit');
    Route::put('/states/{state}', [StateController::class, 'update'])->name('states.update');
    Route::delete('/states/{state}', [StateController::class, 'destroy'])->name('states.destroy');
    
    //subcategories
    Route::get('/subcategories', [subcategoryController::class, 'index'])->name('subcategories.index');
    Route::get('/subcategories/create', [subcategoryController::class, 'create'])->name('subcategories.create');
    Route::post('/subcategories', [subcategoryController::class, 'store'])->name('subcategories.store');
    Route::get('/subcategories/{subcategory}', [subcategoryController::class, 'show'])->name('subcategories.show');
    Route::get('/subcategories/{subcategory}/edit', [subcategoryController::class, 'edit'])->name('subcategories.edit');
    Route::put('/subcategories/{subcategory}', [subcategoryController::class, 'update'])->name('subcategories.update');
    Route::delete('/subcategories/{subcategory}', [subcategoryController::class, 'destroy'])->name('subcategories.destroy');
    Route::post('/submit-complaints', [ComplaintController::class, 'getSubcategories'])->name('get-subcategories');
    

});
    // routes/web.php
    Route::group(['prefix' => '/admin', 'as' => 'admin.'], function () {
        Route::get('register', [UsersController::class, 'register'])->name('register');
        Route::post('register', [UsersController::class, 'registerStore'])->name('registerStore');
        Route::get('login', [UsersController::class, 'login'])->name('login'); // Define the route here
        Route::post('session', [UsersController::class, 'loginStore'])->name('loginStore');
        Route::get('/dashboard', [UsersController::class, 'dashboard'])->name('dashboard')->middleware('auth'); 
        Route::get('/logout', [UsersController::class, 'logout'])->name('logout');
        Route::get('/adminProfile', [UsersController::class, 'adminProfile'])->name('adminProfile');
        Route::get('/edit-profile', [UsersController::class, 'editProfile'])->name('admineditProfile');
        Route::post('/update-profile', [UsersController::class, 'updateProfile'])->name('adminupdateProfile');
        Route::get('admin-password', [UsersController::class, 'AdminChange_password'])->name('admin_password');
        Route::post('/admin-password', [UsersController::class, 'AdminUpdatePassword'])->name('adminPassword');
        //user crud
        Route::get('/userList', [UsersController::class, 'userList'])->name('userList');
        Route::delete('/users/{id}', [UsersController::class, 'destroy'])->name('users.destroy');
        //
        Route::get('/all-complaint', [UsersController::class, 'all_Complaint'])->name('all-complaint');
        Route::get('/Complaint_detail/{id}', [UsersController::class, 'Complaint_detail'])->name('Complaint_detail');
    
        Route::get('/complaint/{id}', [UsersController::class, 'Complaint_Edit'])->name('Complaint_Edit');
        Route::post('Complaint_Update/{id}', [UsersController::class, 'Complaint_Update'])->name('Complaint_Update');

        Route::get('/admin_ragister', [UsersController::class, 'admin_ragister'])->name('admin_ragister');
        Route::post('/customer_ragister', [UsersController::class, 'customer_ragister'])->name('customer_ragister');
       
        Route::get('/search_filter', [UsersController::class, 'search_filter'])->name('search_filter');
        
    
    });

   
   

  
