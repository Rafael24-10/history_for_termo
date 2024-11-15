<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/history', function () {
    return view('game-history');
})->name('game-history');



Route::get('/history/dueto', function () {
    return view('game-history-dueto');
})->name('game-history-dueto');

Route::get('/history/quarteto', function () {
    return view('game-history-quarteto');
})->name('game-history-quarteto');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';
