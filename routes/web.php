<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\VerifyController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/home', function () {
    return view('welcome');
});

#region sign

Route::get('/login', function () {
    return view('login');
})->name('login')->middleware('guest');


Route::get('/register', function () {
    return view('register');
})->name('register')->middleware('guest');

Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/login-post', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
#endregion


#region user
// Protected routes for authenticated users
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::get('/profile/edit/{id}', [UserController::class, 'edit'])->name('profile.edit'); // Get the edit form
    Route::put('/profile/update/{id}', [UserController::class, 'update'])->name('profile.update'); // Update user data

    // Route for admin to edit user profile
    Route::get('/admin/user/edit/{id}', [UserController::class, 'showUpdateProfile'])->name('admin.user.edit');
});

#endregion


#region admin
// Protected routes for admins
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/users', [AdminController::class, 'index'])->name('admin.users');
    Route::put('/admin/users/{id}/update', [UserController::class, 'update'])->name('admin.users.update'); // تعديل بيانات المستخدم
    Route::post('/admin/users/{id}/toggle-status', [AdminController::class, 'toggleStatus'])->name('admin.users.toggle.status');
    Route::delete('/admin/users/{id}/delete', [AdminController::class, 'destroy'])->name('admin.users.delete');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/profile-admin', [AdminController::class, 'showProfile'])->name('profile.show');
    Route::get('/admin/addUser', [AdminController::class, 'createUser'])->name('add.user');
    Route::post('/admin/addUser', [AdminController::class, 'addUser'])->name('add.user.post');

});


#endregion

#region verify
Route::get('/email/verify', function () {
    return view('verifyEmail');
})->name('verification.notice');

Route::post('/email/verify-code', [VerifyController::class, 'verifyCode'])->name('verification.verify');

#endregion
