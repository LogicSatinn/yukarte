<?php

declare(strict_types=1);

use App\Http\Controllers\ProfileController;
use App\Livewire\Home;
use App\Livewire\Setting;
use App\Livewire\WorkoutRoutine\Create;
use App\Livewire\WorkoutRoutine\Index;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function (): void {
    Route::get('', Home::class)->name('home');
    Route::get('setting', Setting::class)->name('setting');
    Route::get('workout-routine', Index::class)->name('workout-routine.index');
    Route::get('workout-routine/create', Create::class)->name('workout-routine.create');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
