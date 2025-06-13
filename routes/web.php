<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\ProfileController\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ExpertDomainController\ExpertDomainController;


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

//navigate based on user role
Route::get('/expertDomain', function () {
    $user = Session::get('user');

    if (!$user) {
        return redirect()->route('login');
    }

    if ($user->role === 'Platinum') {
        return redirect()->route('manageExpertDomain.index');
    } elseif ($user->role === 'CRMP') {
        return redirect()->route('manageExpertDomain.platinumList');
    } else {
        return redirect()->route('login')->with('error', 'Unauthorized role.');
    }
})->name('expertDomain.redirect');

Route::get('/myExpertList', [ExpertDomainController::class, 'index'])->name('manageExpertDomain.index');
Route::get('/platinumList', [ExpertDomainController::class, 'platinumList'])->name('manageExpertDomain.platinumList');
Route::get('/viewPlatinumExpert/{username}', [ExpertDomainController::class, 'viewPlatinumExpert'])->name('manageExpertDomain.viewPlatinumExpert');

//for platinum
//expert domain
Route::get('/MyExpertList', [ExpertDomainController::class, 'index'])->name('manageExpertDomain.index');
Route::get('/AddExpert', [ExpertDomainController::class, 'addExpert'])->name('manageExpertDomain.addExpert');
Route::get('/EditExpert/{id}', [ExpertDomainController::class, 'editExpert'])->name('manageExpertDomain.editExpert');
Route::delete('/DeleteExpert/{id}', [ExpertDomainController::class, 'deleteExpert'])->name('manageExpertDomain.deleteExpert');
Route::post('/AddExpert', [ExpertDomainController::class, 'storeExpert'])->name('manageExpertDomain.storeExpert');
Route::put('/editExpert/{id}', [ExpertDomainController::class, 'update'])->name('manageExpertDomain.update');
Route::get('/platinumExpertList', [ExpertDomainController::class, 'platinumExpertList'])->name('manageExpertDomain.platinumExpertList');


//expert paper
Route::get('/PaperList/{expert_id}', [ExpertDomainController::class, 'paperList'])->name('manageExpertDomain.paperList');
Route::get('/AddPaper/{expert_id}', [ExpertDomainController::class, 'addPaper'])->name('manageExpertDomain.addPaper');
Route::post('/AddPaper/{expert_id}', [ExpertDomainController::class, 'storePaper'])->name('manageExpertDomain.storePaper');
Route::get('/EditPaper/{expertPaper_id}', [ExpertDomainController::class, 'editPaper'])->name('manageExpertDomain.editPaper');
Route::put('/EditPaper/{expertPaper_id}', [ExpertDomainController::class, 'updatePaper'])->name('manageExpertDomain.updatePaper');
Route::delete('/DeletePaper/{expertPaper_id}', [ExpertDomainController::class, 'deletePaper'])->name('manageExpertDomain.deletePaper');

//other platinum expert list
Route::get('/ViewPlatinumExpert/{username}', [ExpertDomainController::class, 'viewPlatinumExpert'])->name('manageExpertDomain.viewPlatinumExpert');
Route::get('/DomainExpertise/{domain_expertise}', [ExpertDomainController::class, 'viewDomainExpertise'])->name('manageExpertDomain.viewDomainExpertise');

//for CRMP
Route::get('/platinumList', [ExpertDomainController::class, 'platinumList'])->name('manageExpertDomain.platinumList');
Route::get('/viewAssignedPlatinumExpert/{username}', [ExpertDomainController::class, 'viewAssignedPlatinumExpert'])->name('manageExpertDomain.viewAssignedPlatinumExpert');
Route::get('/platinumReport/{username}', [ExpertDomainController::class, 'platinumReport'])->name('manageExpertDomain.platinumReport');
Route::get('/notify/{paper_id}', [ExpertDomainController::class, 'notifyPlatinum'])->name('manageExpertDomain.notifyPlatinum');
Route::post('/send-notification', [ExpertDomainController::class, 'sendNotification'])->name('manageExpertDomain.sendNotification');
