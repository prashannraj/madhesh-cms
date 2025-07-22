<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GoogleController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ComplainController;


// Root route: now loads complaint_form.blade.php
//Route::get('/', fn() => view('complain/complaint_form'));
Route::get('/', [ComplainController::class, 'showForm']);


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

//Route::get('/complain', fn() => view('complain/complaint_form'));
// web.php
Route::post('/submit-complaint', [ComplainController::class, 'submit'])->name('complaint.submit');
// Complaint form route, Controller बाट years सहित view पठाउने
Route::get('/complain', [ComplainController::class, 'showForm'])->name('complain.form');
Route::get('/complain/print/{id}', [ComplainController::class, 'print'])->name('complaints.print');
Route::get('/admin/complaints/{id}/download', [\App\Http\Controllers\ComplainController::class, 'downloadPDF'])->name('complaints.download');


//Route::post('/complaint/submit', [ComplainController::class, 'submit'])->name('complaint.submit');




require __DIR__.'/auth.php';
