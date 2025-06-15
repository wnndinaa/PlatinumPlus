<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\ProfileController\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\PublicationController\PublicationController;

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

// Publication Route
Route::get('/publication', [PublicationController::class, 'showViewPublication'])->name('publication');
Route::get('/publication/MyPublication', [PublicationController::class, 'showMyPublication'])->name('publication.MyPublication');
Route::get('/publication/MyPublication/AddMyPublication', [PublicationController::class, 'AddMyPublication'])->name('publication.MyPublication.add');
Route::post('/publication/store', [PublicationController::class, 'storeMyPublication'])->name('publication.store');
Route::delete('/publication/MyPublication/delete/{id}', [PublicationController::class, 'deletePublication'])->name('publication.MyPublication.delete');
Route::get('/publication/MyPublication/EditMyPublication/{id}', [PublicationController::class, 'editMyPublication'])->name('publication.MyPublication.edit');
Route::put('/publication/MyPublication/update/{id}', [PublicationController::class, 'updateMyPublication'])->name('publication.MyPublication.update');
Route::get('/publicationReport', [PublicationController::class, 'showPublicationReport'])->name('publication.report');
Route::post('/publicationReport/filter', [PublicationController::class, 'viewPublicationReport'])->name('publication.report.filter');
