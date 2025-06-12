<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ReportController\ReportController;
<<<<<<< Updated upstream
<<<<<<< Updated upstream
=======
=======

>>>>>>> Stashed changes

>>>>>>> Stashed changes



// Route for the homepage
Route::get('/', function () {
    return view('welcome');
});


// Route for the profile index page
Route::get('/profile', [ProfileController::class, 'index']);

// Profile routes (optional: also protect these with session check if needed)
Route::get('/profile', [ProfileController::class, 'index'])->name('profile.profile');
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');


//draftThesis routes
Route::get('/draftThesis', [ReportController::class, 'index'])->name('draftThesis.index');
Route::get('/draftThesis/create', [ReportController::class, 'create'])->name('draftThesis.create');
Route::post('/draftThesis', [ReportController::class, 'store'])->name('draftThesis.store');
<<<<<<< Updated upstream
<<<<<<< Updated upstream

=======
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
