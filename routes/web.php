<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ReportController\ReportController;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;


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
Route::get('/draft-thesis/{id}/edit', [ReportController::class, 'edit'])->name('draftThesis.edit');
Route::put('/draft-thesis/{id}', [ReportController::class, 'update'])->name('draftThesis.update');
Route::get('/draftThesis/{id}/feedback', [ReportController::class, 'viewFeedback'])->name('draftThesis.viewfeedback');
Route::delete('/draftthesis/{id}', [ReportController::class, 'destroy'])->name('draftthesis.destroy');

Route::resource('draftThesis', ReportController::class);

//CRMP pov for draft's thesis
Route::get('/crmp/platinums', [ReportController::class, 'crmpPlatinumList'])->name('draftThesis.platinumList');
Route::get('/crmp/platinum/{username}/drafts', [ReportController::class, 'viewPlatinumDrafts'])->name(name: 'draftThesis.platinumDrafts');

// Show the add feedback form
Route::get('/feedback/{id}/add', [ReportController::class, 'addFeedback'])->name('draftThesis.addfeedback');

// Handle feedback submission
Route::post('/feedback/{id}/store', [ReportController::class, 'storeFeedback'])->name('draftThesis.storefeedback');

// Show the edit feedback form
Route::get('/feedback/{id}/edit', [ReportController::class, 'editFeedback'])->name('draftThesis.editfeedback');

// Update feedback (optional if you handle edit submission separately)
Route::put('/feedback/{id}', [ReportController::class, 'updateFeedback'])->name('draftThesis.updatefeedback');

Route::delete('/feedback/{id}/delete', [ReportController::class, 'deleteFeedback'])->name('draftThesis.deletefeedback');

//view report draft thesis
Route::get('/draftthesis/report', [ReportController::class, 'viewAllPlatinumReport'])->name('draftThesis.allPlatinumReport');

//report draft thesis
Route::get('/draft-thesis/report', [ReportController::class, 'draftThesisReport'])->name('draftThesis.crmpReport');

//Weekly progress ROUTE
Route::get('/weeklyProgress', [ReportController::class, 'weeklyProgressIndex'])->name('weeklyprogress.index');

// Create form for Weekly Progress
Route::get('/weeklyProgress/create', [ReportController::class, 'weeklyProgressCreate'])->name('weeklyprogress.create');
// Store Weekly Progress
Route::post('/weeklyProgress', [ReportController::class, 'weeklyProgressStore'])->name('weeklyprogress.store');
//edit weekly progress
Route::get('/weeklyProgress/{id}/edit', [ReportController::class, 'weeklyProgressEdit'])->name('weeklyprogress.edit');
// Update Weekly Progress
Route::put('/weeklyProgress/{id}', [ReportController::class, 'weeklyProgressUpdate'])->name('weeklyprogress.update');
//delete weekly progress
Route::delete('/weeklyProgress/{id}', [ReportController::class, 'weeklyProgressDestroy'])->name('weeklyprogress.destroy');
//view feedback
Route::get('/weeklyProgress/{id}/feedback', [ReportController::class, 'showWeeklyProgressFeedback'])->name('weeklyprogress.viewFeedback');

//crmp route weekly progress
// Show CRMP their assigned Platinums
Route::get('/weeklyProgress/platinumList', [ReportController::class, 'crmpWeeklyProgressList'])->name('weeklyprogress.WPplatinumList');
//crmp view submitted WP for his/her assigned Platinum
Route::get('/weeklyProgress/{username}/WPlist', [ReportController::class, 'showPlatinumWeeklyList'])->name('weeklyprogress.WPviewPlatinumProgress');
//weeklyprogress feedback
Route::get('/weeklyProgress/{id}/feedback/add', [ReportController::class, 'WPaddFeedback'])->name('weeklyprogress.addfeedback');
Route::post('/weeklyProgress/{id}/feedback/store', [ReportController::class, 'WPstoreFeedback'])->name('weeklyprogress.storefeedback');
Route::get('/weeklyProgress/{id}/feedback/edit', [ReportController::class, 'WPeditFeedback'])->name('weeklyprogress.editfeedback');
Route::put('/weeklyProgress/{id}/feedback/update', [ReportController::class, 'WPupdateFeedback'])->name('weeklyprogress.updatefeedback');
Route::delete('/weeklyProgress/{id}/feedback/delete', [ReportController::class, 'WPdeleteFeedback'])->name('weeklyprogress.deletefeedback');
Route::get('/report/weeklyProgress', [ReportController::class, 'weeklyProgressReport'])->name('weeklyprogress.report');

//logout
Route::post('/logout', function () {
    Session::flush(); // Clear all session data
    return redirect()->route('login')->with('success', 'You have been logged out.');
})->name('logout');
