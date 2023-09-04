<?php

use App\Http\Livewire\Home;
use App\Http\Livewire\Setting;
use Illuminate\Support\Facades\Route;

Route::get('parse-yaml', function () {
   dd(\Symfony\Component\Yaml\Yaml::parseFile(storage_path('routine-template.yaml')));
});

Route::get('/', Home::class)->name('home');
Route::get('/setting', Setting::class)->name('setting');

