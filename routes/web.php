<?php
// routes/web.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExperienceController;

// Welcome page
Route::get('/', [ExperienceController::class, 'welcome'])->name('welcome');

// Auth routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected experience routes
Route::middleware(['check.auth'])->group(function () {
    Route::get('/loading', [ExperienceController::class, 'loading'])->name('loading');
    Route::get('/romantic-letter', [ExperienceController::class, 'romanticLetter'])->name('romantic.letter');
    Route::get('/photo-loading', [ExperienceController::class, 'photoLoading'])->name('photo.loading');
    Route::get('/quiz', [ExperienceController::class, 'quiz'])->name('quiz');
    Route::get('/upload', [ExperienceController::class, 'showUpload'])->name('upload');
    Route::post('/upload', [ExperienceController::class, 'uploadPhoto']);
    Route::get('/letter', [ExperienceController::class, 'showLetter'])->name('letter');
    Route::post('/letter', [ExperienceController::class, 'submitLetter']);
    Route::get('/closing', [ExperienceController::class, 'closing'])->name('closing');
});
