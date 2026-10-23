<?php

use App\Http\Controllers\GoogleOAuthController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/', function () {
    return view('welcome');
});

Route::get('/auth/google/redirect', [
    GoogleOAuthController::class,
    'redirect',
])->name('auth.google.redirect');

Route::get('/auth/google/callback', [
    GoogleOAuthController::class,
    'callback',
])->name('auth.google.callback');

require __DIR__.'/auth.php';
