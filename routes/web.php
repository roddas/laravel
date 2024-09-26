<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

// Home
Route::view('/','posts.index')->name('home');

// Register
Route::view('/register','auth.register')->name('register');
Route::post('/register', [ AuthController::class, 'register' ] );

// Login
Route::view('/login','auth.login')->name('login');
Route::post('/login', [ AuthController::class, 'login' ] );


// Dashboard
Route::get('/dashboard', [ DashboardController::class, 'index' ] )->name('dashboard');
Route::post('/logout', [ AuthController::class, 'logout' ] )->name('logout');

