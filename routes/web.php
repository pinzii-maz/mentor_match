<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', function () {
    return view('welcome');
});

// Auth routes
Route::middleware(['auth', 'verified'])->group(function () {
    // Main dashboard route
    Route::get('/dashboard', [DashboardController::class, 'redirectToDashboard'])
         ->name('dashboard');
    
    // Mentor routes
    Route::prefix('mentor')->group(function () {
        Route::get('/dashboard', function () {
            if (auth()->user()->role !== 'mentor') {
                abort(403);
            }
            return view('mentor.dashboard');
        })->name('mentor.dashboard');
    });
    
    // Mentee routes
    Route::prefix('mentee')->group(function () {
        Route::get('/dashboard', function () {
            if (auth()->user()->role !== 'mentee') {
                abort(403);
            }
            return view('mentee.dashboard');
        })->name('mentee.dashboard');
    });
    
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';