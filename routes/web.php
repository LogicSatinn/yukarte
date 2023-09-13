<?php

declare(strict_types=1);

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoutineController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('test', fn () => Inertia::render('Test'))->name('test');

Route::middleware('auth')->group(function (): void {
    Route::get('/', HomeController::class)->name('home');
    Route::get('/routine', [RoutineController::class, 'index'])->name('routine.index');
    Route::get('/routine/create', [RoutineController::class, 'create'])->name('routine.create');
    Route::post('/routine', [RoutineController::class, 'store'])->name('routine.store');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('test', function () {
    app(\App\Actions\GenerateFirstCycle::class)();

    return 'success';
});

require __DIR__ . '/auth.php';
