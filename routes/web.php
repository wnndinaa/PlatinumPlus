<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ReportController\ReportController;

// Landing page redirects to login
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');

// Login routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.process');

// Register routes
Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'processRegister'])->name('register.submit');

// Protected welcome route
Route::get('/welcome', function () {
    if (!Session::has('user')) {
        return redirect()->route('login')->with('error', 'Please login first.');
    }
    return view('welcome');
})->name('welcome');

// Profile routes (optional: also protect these with session check if needed)
Route::get('/profile', [ProfileController::class, 'index'])->name('profile.profile');
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');


//draftThesis routes
Route::get('/draftThesis', [ReportController::class, 'index'])->name('draftThesis.index');
Route::get('/draftThesis/create', [ReportController::class, 'create'])->name('draftThesis.create');
Route::post('/draftThesis', [ReportController::class, 'store'])->name('draftThesis.store');

