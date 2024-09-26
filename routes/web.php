<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;



// Logged
Route::middleware(['auth'])->group(function (){

  // Dashboard
    Route::get('/dashboard', [ DashboardController::class, 'index' ] )->name('dashboard');
    Route::post('/logout', [ AuthController::class, 'logout' ] )->name('logout');
});

// Guest
Route::middleware(['guest'])->group(function (){

    // Home page
    Route::view('/','posts.index')->name('home');

    // Register
    Route::view('/register','auth.register')->name('register');
    Route::post('/register', [ AuthController::class, 'register' ] );

    // Login
    Route::view('/login','auth.login')->name('login');
    Route::post('/login', [ AuthController::class, 'login' ] );

});