<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\ProfileController\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;

// Landing page redirects to login
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');

// Login routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.process');

// Logout route
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Register routes
Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'processRegister'])->name('register.submit');

// Protected welcome route (via HomeController)
Route::get('/welcome', [HomeController::class, 'welcome'])->name('welcome');

// Export user list (only for staff)
Route::get('/export-users', [HomeController::class, 'exportUsers'])->name('export.users');
Route::delete('/user/delete/{username}', [App\Http\Controllers\HomeController::class, 'deleteUser'])->name('delete.user');

// Profile routes
Route::get('/profile', [ProfileController::class, 'index'])->name('profile.profile');
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

// Profile search & view (if applicable)
Route::get('/profiles', [ProfileController::class, 'search'])->name('profiles.search');
Route::get('/profiles/{username}', [ProfileController::class, 'viewProfile'])->name('profiles.view');
