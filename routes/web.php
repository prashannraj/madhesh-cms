<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GoogleController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ComplainController;

// Root route: now loads complaint_form.blade.php
Route::get('/', fn() => view('complain/complaint_form'));

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('google.login');
Route::get('/auth/google/callback', [GoogleController::class, 'callback']);

Route::get('/complain', fn() => view('complain/complaint_form'));
// web.php
Route::post('/submit-complaint', [ComplainController::class, 'submit'])->name('complaint.submit');

//Route::post('/complaint/submit', [ComplainController::class, 'submit'])->name('complaint.submit');




require __DIR__.'/auth.php';
