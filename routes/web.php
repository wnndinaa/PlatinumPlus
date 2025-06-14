<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\ProfileController\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UserController\UserController as UserController;


// Landing page redirects to login
Route::get('/', [LoginController::class, 'showLoginForm']); // Remove ->name('login')

// Login routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login'); // Keep only this named 'login'
Route::post('/login', [LoginController::class, 'login'])->name('login.process');

// Logout route
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Register routes
Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'processRegister'])->name('register.submit');

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

// Protected welcome route (via HomeController)
Route::get('/user-list', [UserController::class, 'userList'])->name('user.list');
Route::delete('/user/delete/{username}', [UserController::class, 'deleteUser'])->name('delete.user');
Route::get('/export-users', [UserController::class, 'exportUsers'])->name('export.users');

// Profile routes
Route::get('/profile', [ProfileController::class, 'index'])->name('profile.profile');
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

// Profile search & view (if applicable)
Route::get('/profiles', [ProfileController::class, 'search'])->name('profiles.search');
Route::get('/profiles/{username}', [ProfileController::class, 'viewProfile'])->name('profiles.view');
