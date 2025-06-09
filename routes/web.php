<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController\ProfileController;

// Route for the homepage
Route::get('/', function () {
    return view('welcome');
});

// Route for the profile index page
Route::get('/profile', [ProfileController::class, 'index']);
