<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\Home;
use App\Livewire\WorkoutRoutine;
use App\Livewire\Setting;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('', Home::class)->name('home');
    Route::get('setting', Setting::class)->name('setting');
    Route::get('workout-routine', WorkoutRoutine::class)->name('workout-routine');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
